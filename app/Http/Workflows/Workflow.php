<?php

namespace App\Http\Workflows;

use App\Models\StateStage;
use App\Models\WorkflowRequest;

abstract class Workflow
{
    protected WorkflowRequest $workflowRequest;
    public array $stages = [];

    abstract public function setStages(): void;

    public function __construct(WorkflowRequest $workflowRequest)
    {
        $this->workflowRequest = $workflowRequest;
        $this->setStages();
    }

    public function getCurrentStage(): ?Stage
    {
        $stage = $this->workflowRequest->getLastStage();
        if ($stage) {
            return $this->stages[$stage->stage];
        }

        return null;
    }

    public function acceptCurrentStage(?string $json = null): void
    {
        $this_stage = $this->workflowRequest->getLastStage();
        if ($this_stage) {
            $this_stage->update([
                'state' => 1,
                'user_id' => auth()->id(),
                'json' => $json,
            ]);
        }
    }
}
