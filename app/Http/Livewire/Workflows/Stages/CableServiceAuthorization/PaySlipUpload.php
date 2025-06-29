<?php

namespace App\Http\Livewire\Workflows\Stages\CableServiceAuthorization;

use App\Http\Workflows\WorkflowManager;
use App\Mail\UserNotify;
use App\Models\StateStage;
use App\Models\WorkflowRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaySlipUpload extends Component
{
    use WithFileUploads;
    public WorkflowRequest $workflowRequest;
    public StateStage $stateStage, $last_stage;
    public $json, $form, $documents, $upload_documents_json, $pay_slip, $adicional_data, $seller, $new_owner, $previous_stage;
    protected $rules = [
        'pay_slip' => ['required', 'file', 'mimes:pdf'],
        'adicional_data' => ['nullable', 'string'],
    ];
    public function mount($key): void
    {
        $this->workflowRequest = WorkflowRequest::where('key', $key)->firstOrFail();
        $this->previous_stage = json_decode($this->workflowRequest->getPreviousStage()->json, true);
        $this->stateStage = $this->workflowRequest->stateStages[0];
        $this->last_stage = $this->workflowRequest->getLastStage();
        $this->upload_documents_json = json_decode($this->stateStage->json, true);
        $this->form = $this->upload_documents_json['form'] ?? [];
        $this->documents = $this->upload_documents_json['documents'] ?? [];
        $this->seller = $this->upload_documents_json['seller'] ?? [];
        $this->new_owner = $this->upload_documents_json['new_owner'] ?? [];
    }
    public function submit(): void
    {
        $this->validate();
        $data = [
            'pay_slip' => Storage::put('documents', $this->pay_slip)
        ];
        $mail_data = [
            'subject' =>  $this->workflowRequest->workflow->name,
            'title' => 'Boleta de pago',
            'subtitle' => 'Te compartimos la boleta para realizar el pago, luego sube los datos solicitados al sistema.',
            'description' => $this->adicional_data,
            'files' => [$data['pay_slip']],
            'key' => $this->workflowRequest->key
        ];
        Mail::to($this->workflowRequest->user->email)->send(new UserNotify($mail_data));
        $workflowManager = new WorkflowManager($this->workflowRequest);
        $workflowManager->acceptCurrentStage(json_encode($data));
    }
    public function render(): View
    {
        if ($this->workflowRequest->hasPermission()) {
            return view('livewire.workflows.stages.cable-service-authorization.pay-slip-upload');
        } else {
            return view('errors.403');
        }
    }
}
