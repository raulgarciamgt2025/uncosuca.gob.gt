<?php

namespace App\Http\Livewire\Workflows\Stages;

use App\Http\Workflows\WorkflowManager;
use App\Mail\UserNotify;
use App\Models\Company;
use App\Models\StateStage;
use App\Models\WorkflowRequest;
use App\Traits\Mails;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class DocumentsReview extends Component
{
    use Mails;

    public WorkflowRequest $workflowRequest;
    public StateStage $stateStage, $last_stage;
    public $json, $form, $documents, $inputs = [], $confirm_modal = false, $rejected_modal = false, $observations,
        $upload_documents_json, $rejected_inputs, $seller, $new_owner, $alert_error, $company;
    protected $rules = [];
    public function mount($key): void
    {
        $this->workflowRequest = WorkflowRequest::where('key', $key)->firstOrFail();
        $this->stateStage = $this->workflowRequest->getPreviousStage();
        $this->last_stage = $this->workflowRequest->getLastStage();
        $this->upload_documents_json = json_decode($this->stateStage->json, true);
        $this->form = $this->upload_documents_json['form'] ?? [];
        $this->documents = $this->upload_documents_json['documents'] ?? [];
        $this->seller = $this->upload_documents_json['seller'] ?? [];
        $this->new_owner = $this->upload_documents_json['new_owner'] ?? [];
        foreach (array_merge($this->form, $this->documents, $this->seller, $this->new_owner) as $name => $field) {
            $this->inputs[$name] = false;
            $this->rules['inputs.'.$name] = ['required', 'boolean'];
        }
    }

    public function showConfirmModal(): void
    {
        $this->rejected_inputs = array_filter($this->inputs, function ($item) {
            return $item === true;
        });
        if (count($this->rejected_inputs) > 0) {
            $this->confirm_modal = true;
        } else {
            $this->submit();
        }
    }

    public function showRejectedModal(): void
    {
        $this->rejected_modal = true;
    }

    public function rejected(): void
    {
        $this->rejectedMail($this->workflowRequest, $this->observations);
    }
    public function submit(): void
    {
        $this->alert_error = null;
        if (count($this->rejected_inputs) > 0) {
            $title = 'Resultado de revisión de requisitos';
            $data = [
                'subject' =>  $this->workflowRequest->workflow->name,
                'title' => $title,
                'subtitle' => 'Ingresa al sistema para completar los datos solicitados.',
                'list' => $this->json,
                'description' => $this->observations,
                'key' => $this->workflowRequest->key
            ];
            Mail::to($this->workflowRequest->user->email)->send(new UserNotify($data));
            $this->stateStage->state = 0;
            $this->upload_documents_json['corrections'] = $this->json;
            $this->stateStage->json = json_encode($this->upload_documents_json);
            $last_stage = $this->workflowRequest->getLastStage();
            $history = $last_stage->history;
            $history[] = [
                'title' => $title,
                'list' => $this->json,
                'description' => $this->observations,
                'date' => date('Y-m-d H:i:s')
            ];
            $last_stage->history = $history;
            $last_stage->save();
            $this->stateStage->save();
            $this->workflowRequest->state = 0;
            $this->workflowRequest->save();
            session()->flash('success', 'Se ha notificado al usuario.');
            $this->redirect(auth()->user()->type == 1 ? '/workflows-my-requests' : '/workflows-review-requests');
        } elseif ($this->workflowRequest->workflow->type > 1) {
            if (!$this->workflowRequest->company) {
                $this->validate([
                    'company' => ['required', 'exists:companies,id']
                ]);
                $company = Company::find($this->company);
                $assigned_user = $company->assignedUsers()
                    ->where('user_id', $this->workflowRequest->request_user_id)->first();
                if (!$assigned_user) {
                    $company->assignedUsers()->create([
                        'user_id' => $this->workflowRequest->request_user_id
                    ]);
                }
                $this->workflowRequest->company_id = $company->id;
                $this->workflowRequest->save();
            }
            $workflowManager = new WorkflowManager($this->workflowRequest);
            $workflowManager->acceptCurrentStage();
        } else {
            $workflowManager = new WorkflowManager($this->workflowRequest);
            $workflowManager->acceptCurrentStage();
        }
    }
    public function render(): View
    {
        if ($this->workflowRequest->hasPermission()) {
            return view('livewire.workflows.stages.documents-review');
        } else {
            return view('errors.403');
        }
    }
}
