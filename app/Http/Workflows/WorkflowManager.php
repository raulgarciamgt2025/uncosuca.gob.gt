<?php

namespace App\Http\Workflows;

use App\Http\Controllers\Controller;
use App\Http\Workflows\Process\CableServiceAuthorization;
use App\Http\Workflows\Process\CancellationOfAuthorization;
use App\Http\Workflows\Process\ExtendedCoverage;
use App\Http\Workflows\Process\LicenseRenewal;
use App\Http\Workflows\Process\NameOwnerBusinessChange;
use App\Http\Workflows\Process\PurchaseSaleAuthorization;
use App\Http\Workflows\Process\SocialReasonChange;
use App\Models\WorkflowRequest;
use Auth;
use Exception;

class WorkflowManager
{
    private WorkflowRequest $workflowRequest;

    public function __construct(WorkflowRequest $workflowRequest)
    {
        $this->workflowRequest = $workflowRequest;
    }

    public static function getWorkflowAvailable(): array
    {
        $unique_types = [1];
        $user_workflows = auth()->user()->workflowRequests()->whereIn('state', [1,2])->whereHas('workflow', function ($workflow) use($unique_types) {
            $workflow->whereIn('type', $unique_types);
        })->get();
        $types = [];
        foreach ($user_workflows as $user_workflow) {
            $types[] = $user_workflow->workflow->type;
        }
        return [
            'workflows' => \App\Models\Workflow::orderBy('id')->get(),
            'user_workflows_request' => $types
        ];
    }

    public function getWorkflowByType(): ?Workflow
    {
        return match ($this->workflowRequest->workflow->type) {
            1 => new CableServiceAuthorization($this->workflowRequest),
            2 => new ExtendedCoverage($this->workflowRequest),
            3 => new LicenseRenewal($this->workflowRequest),
            4 => new PurchaseSaleAuthorization($this->workflowRequest),
            5 => new CancellationOfAuthorization($this->workflowRequest),
            6 => new SocialReasonChange($this->workflowRequest),
            7 => new NameOwnerBusinessChange($this->workflowRequest),
            default => null,
        };
    }

    public function getWorkflowStages(): array
    {
        $workflow = $this->getWorkflowByType();
        return $workflow->stages;
    }

    public function dispatchCurrentStage(string $route): void
    {
        $workflow = $this->getWorkflowByType();
        $stage = $workflow->getCurrentStage();
        if ($stage instanceof Stage) {
            if ($stage->prepare()) {
                $stage->process();
            } else {
                redirect($route)->with('error', $stage->getMessage());
            }
        } else {
            redirect($route)->with('success', 'Este proceso ha finalizado.');
        }
    }

    public function acceptCurrentStage(?string $json = null): void
    {
        $workflow = $this->getWorkflowByType();
        $stage = $workflow->getCurrentStage();
        $controller = new Controller();
        $route = $controller->getRouteByType(\Illuminate\Support\Facades\Auth::user()->type);
        if ($stage instanceof Stage) {
            $stage->complete();
            $workflow->acceptCurrentStage($json);
            redirect($route)->with('success', 'Etapa finalizada correctamente.');
        } else {
            redirect($route)->with('error', 'Ocurrió un error al finalizar el proceso.');
        }
    }

    public function getCurrentWorkflowStage(WorkflowRequest $workflowRequest): ?Stage
    {
        $workflow = $this->getWorkflowByType($workflowRequest->type);
        return $workflow->getCurrentStage();
    }
}
