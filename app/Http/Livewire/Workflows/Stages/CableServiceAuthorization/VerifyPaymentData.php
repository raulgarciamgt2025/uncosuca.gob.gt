<?php

namespace App\Http\Livewire\Workflows\Stages\CableServiceAuthorization;

use App\Http\Workflows\WorkflowManager;
use App\Mail\UserNotify;
use App\Models\StateStage;
use App\Models\WorkflowRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class VerifyPaymentData extends Component
{
    public WorkflowRequest $workflowRequest;
    public StateStage $stateStage, $last_stage;
    public $json, $form, $upload_documents_json, $rejected_inputs, $confirm_modal = false, $observations, $message = 'Finalizar proceso';
    public $inputs = [
        'voucher' => false,
        'subscribers_number' => false,
        'voucher_number' => false,
        'voucher_amount' => false,
    ];
    public $inputs_desc = [
        'voucher' => 'BOLETA',
        'subscribers_number' => 'NÚMERO DE SUSCRIPTORES',
        'voucher_number' => 'NÚMERO DE BOLETA',
        'voucher_amount' => 'MONTO DE BOLETA',
    ];
    protected $rules = [];
    public function mount($key): void
    {
        $this->workflowRequest = WorkflowRequest::where('key', $key)->firstOrFail();
        $this->stateStage = $this->workflowRequest->getPreviousStage();
        $this->upload_documents_json = json_decode($this->stateStage->json, true);
    }

    public function updateMessage():void
    {
        $this->rejected_inputs = array_filter($this->inputs, function ($item) {
            return $item === true;
        });
        $this->message = count($this->rejected_inputs) > 0 ? 'Enviar correcciones' : 'Finalizar proceso';
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
    public function submit(): void
    {
        if (count($this->rejected_inputs) > 0) {
            $data = [
                'subject' =>  $this->workflowRequest->workflow->name,
                'title' => 'Resultado de revisión de datos de pago',
                'subtitle' => 'Ingresa al sistema para completar los datos solicitados',
                'list' => $this->json,
                'description' => $this->observations,
                'key' => $this->workflowRequest->key
            ];
            Mail::to($this->workflowRequest->user->email)->send(new UserNotify($data));
            $this->stateStage->state = 0;
            $this->upload_documents_json['corrections'] = $this->json;
            $this->stateStage->json = json_encode($this->upload_documents_json);
            $this->stateStage->save();
            session()->flash('success', 'Se ha notificado al usuario.');
            $this->redirect(auth()->user()->type == 1 ? '/workflows-my-requests' : '/workflows-review-requests');
        } else {
            $files = json_decode($this->workflowRequest->stateStages[5]->json, true);
            $data = [
                'subject' =>  $this->workflowRequest->workflow->name,
                'title' => '¡FELICIDADES!',
                'subtitle' => 'El proceso ha finalizado exitosamente',
                'list' => [],
                'description' => 'Te compartimos la resolución firmada electrónicamente, puedes verificar la autenticidad escaneando el código QR',
                'key' => $this->workflowRequest->key,
                'files' => [
                    $files['authorization']
                ],
            ];
            Mail::to($this->workflowRequest->user->email)->send(new UserNotify($data));
            $workflowManager = new WorkflowManager($this->workflowRequest);
            $workflowManager->acceptCurrentStage();
        }
    }
    public function render(): View
    {
        if ($this->workflowRequest->hasPermission()) {
            return view('livewire.workflows.stages.cable-service-authorization.verify-payment-data');
        } else {
            return view('errors.403');
        }
    }
}
