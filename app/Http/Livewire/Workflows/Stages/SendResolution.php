<?php

namespace App\Http\Livewire\Workflows\Stages;

use App\Http\Workflows\WorkflowManager;
use App\Mail\UserNotify;
use App\Models\StateStage;
use App\Models\WorkflowRequest;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SendResolution extends Component
{
    public WorkflowRequest $workflowRequest;
    public $previous_stage, $last_stage;

    public function mount($key)
    {
        $this->workflowRequest = WorkflowRequest::where('key', $key)->first();
        $this->previous_stage = json_decode($this->workflowRequest->getPreviousStage()->json, true);
    }

    public function submit()
    {
        $data = [
            'subject' =>  $this->workflowRequest->workflow->name,
            'title' => '¡FELICIDADES!',
            'subtitle' => 'El proceso ha finalizado exitosamente',
            'list' => [],
            'description' => 'Te compartimos la resolución firmada electrónicamente, puedes verificar la autenticidad escaneando el código QR',
            'key' => $this->workflowRequest->key,
            'files' => [
                $this->previous_stage['authorization']
            ],
        ];
        Mail::to($this->workflowRequest->user->email)->send(new UserNotify($data));
        $workflowManager = new WorkflowManager($this->workflowRequest);
        $workflowManager->acceptCurrentStage();
    }
    public function render()
    {
        return view('livewire.workflows.stages.send-resolution');
    }
}
