<?php

namespace App\Http\Livewire\Workflows\Stages;

use App\Http\Workflows\WorkflowManager;
use App\Mail\UserNotify;
use App\Models\StateStage;
use App\Models\WorkflowRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class JuridicAuthorization extends Component
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
        $this->last_stage = $this->workflowRequest->getLastStage();
        $this->stateStage = $this->workflowRequest->stateStages[0];
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
        $data = [
            'subject' =>  $this->workflowRequest->workflow->name,
            'title' => 'El proceso ha sido anulado',
            'subtitle' => 'Tu trámite fue rechazado por el siguiente motivo:',
            'description' => $this->observations,
            'key' => $this->workflowRequest->key
        ];
        Mail::to($this->workflowRequest->user->email)->send(new UserNotify($data));
        $this->workflowRequest->state = 3;
        $this->workflowRequest->end_date = date('Y-m-d H:i:s');
        $this->workflowRequest->save();
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
        $data = [
            'subject' =>  $this->workflowRequest->workflow->name,
            'title' => 'Expediente rechazado',
            'subtitle' => 'El expediente fue rechazado un auxiliar jurídico',
            'description' => $this->observations,
            'key' => $this->workflowRequest->key
        ];
        $email = $previous_stage->department->user->email;
        Mail::to($email)->send(new UserNotify($data));
        $json_previous = json_decode($previous_stage->json, true);
        $json_previous['reject_motive'] = $this->observations;
        $previous_stage->json = json_encode($json_previous);
        $previous_stage->state = 0;
        $previous_stage->save();
        session()->flash('success', 'Se ha enviado un correo de para notificar al departamento correspondiente');
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
            return view('livewire.workflows.stages.juridic-authorization');
        } else {
            return view('errors.403');
        }
    }
}
