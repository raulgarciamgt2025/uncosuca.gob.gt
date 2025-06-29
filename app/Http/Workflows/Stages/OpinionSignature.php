<?php

namespace App\Http\Workflows\Stages;

use App\Http\Workflows\Stage;
use App\Mail\UserNotify;
use App\Models\Department;
use App\Models\User;
use App\Models\WorkflowRequest;
use Illuminate\Support\Facades\Mail;

class OpinionSignature implements Stage
{
    private string $message = 'Upload Documents';
    private WorkflowRequest $workflowRequest;

    public function __construct(WorkflowRequest $workflowRequest)
    {
        $this->workflowRequest = $workflowRequest;
    }

    public function prepare(): bool
    {
        /*
         * TODO: si hubiera un error en la preparación de la etapa se retorna false y se agrega un valor a message
         * $this->message = 'Error message';
         */
        return $this->workflowRequest->hasPermission();
    }

    public function process(): void
    {
        //TODO: Puede invocar una vista o realizar una acción como envío de correos
        redirect()->route('opinion-signature', $this->workflowRequest->key);
    }

    public function complete(): void
    {
        // Encontrar al director general
        $manager = Department::find(3)->user;
        $data = [
            'subject' =>  'Nueva autorización para firmar',
            'title' => 'Nueva autorización para firmar',
            'subtitle' => 'Nuevo trámite de '. $this->workflowRequest->workflow->name,
            'description' => 'Ingresa a '.route('workflows-review-requests'). ' para revisarlo.',
            'key' => $this->workflowRequest->key
        ];
        Mail::to($manager->email)->send(new UserNotify($data));
    }

    public function getAssignType(): string
    {
        //TODO: Los campos de asignación son necesarios en la base de datos para identificar si la etapa se debe mostrar al usuario
        return User::class;
    }

    public function getAssignId(): ?int
    {
        return auth()->id();
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
