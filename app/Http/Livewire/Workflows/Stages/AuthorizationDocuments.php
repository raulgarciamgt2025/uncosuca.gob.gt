<?php

namespace App\Http\Livewire\Workflows\Stages;

use App\Http\Workflows\WorkflowManager;
use App\Mail\UserNotify;
use App\Models\StateStage;
use App\Models\WorkflowRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class AuthorizationDocuments extends Component
{
    public WorkflowRequest $workflowRequest;
    public StateStage $stateStage, $last_stage;
    public $json, $form, $documents, $modal_reject = false, $modal_cancel = false, $observations,
        $upload_documents_json, $rejected_inputs, $seller, $new_owner;
    protected $rules = [
        'observations' => ['required', 'string']
    ];
    public function mount($key): void
    {
        $this->workflowRequest = WorkflowRequest::where('key', $key)->firstOrFail();
        $this->stateStage = $this->workflowRequest->stateStages[0];
        $this->last_stage = $this->workflowRequest->getLastStage();
        $this->upload_documents_json = json_decode($this->stateStage->json, true);
        $this->form = $this->upload_documents_json['form'] ?? [];
        $this->documents = $this->upload_documents_json['documents'] ?? [];
        $this->seller = $this->upload_documents_json['seller'] ?? [];
        $this->new_owner = $this->upload_documents_json['new_owner'] ?? [];
    }
    public function showModal($modal): void
    {
        $this->$modal = true;
    }
    public function cancelProcess(): void
    {
        $this->validate();
        $title = 'El proceso ha sido anulado';
        $data = [
            'subject' =>  $this->workflowRequest->workflow->name,
            'title' => $title,
            'subtitle' => 'Tu trámite fue rechazado por el siguiente motivo:',
            'description' => $this->observations,
            'key' => $this->workflowRequest->key
        ];
        Mail::to($this->workflowRequest->user->email)->send(new UserNotify($data));
        $this->workflowRequest->state = 3;
        $this->workflowRequest->end_date = date('Y-m-d H:i:s');
        $this->workflowRequest->save();
        $last_stage = $this->workflowRequest->getLastStage();
        $history = $last_stage->history;
        $history[] = [
            'title' => $title,
            'list' => [],
            'description' => $this->observations,
            'date' => date('Y-m-d H:i:s')
        ];
        $last_stage->history = $history;
        $last_stage->save();
        $workflowManager = new WorkflowManager($this->workflowRequest);
        $observations = json_encode([
            'observations' => $this->observations
        ]);
        $workflowManager->acceptCurrentStage($observations);
    }
    public function rejected(): void
    {
        $this->validate();
        $previous_stage = $this->workflowRequest->getPreviousStage();
        $title = 'Expediente rechazado';
        $data = [
            'subject' =>  $this->workflowRequest->workflow->name,
            'title' => $title,
            'subtitle' => 'El expediente fue rechazado por la dirección de registro',
            'description' => $this->observations,
            'key' => $this->workflowRequest->key
        ];
        $emails = $previous_stage->department->users()->pluck('email')->toArray();
        Mail::to($emails)->send(new UserNotify($data));
        $last_stage = $this->workflowRequest->getLastStage();
        $history = $last_stage->history;
        $history[] = [
            'title' => $title,
            'list' => [],
            'description' => $this->observations,
            'date' => date('Y-m-d H:i:s')
        ];
        $last_stage->history = $history;
        $last_stage->save();
        $json_previous = json_decode($previous_stage->json, true);
        $json_previous['reject_motive'] = $this->observations;
        $previous_stage->json = json_encode($json_previous);
        $previous_stage->state = 0;
        $previous_stage->save();
        session()->flash('success', 'Se ha notificado a los auxiliares del departamento de registro');
        $this->redirect(auth()->user()->type == 1 ? '/workflows-my-requests' : '/workflows-review-requests');
    }
    public function submit(): void
    {
        $workflowManager = new WorkflowManager($this->workflowRequest);
        $workflowManager->acceptCurrentStage();
    }
    public function render(): View
    {
        if ($this->workflowRequest->hasPermission()) {
            return view('livewire.workflows.stages.authorization-documents');
        } else {
            return view('errors.403');
        }
    }
}
