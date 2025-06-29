<?php

namespace App\Http\Workflows\Process;

use App\Http\Workflows\Stages\AuthorizationDocuments;
use App\Http\Workflows\Stages\DirectionSignature;
use App\Http\Workflows\Stages\DocumentsReview;
use App\Http\Workflows\Stages\JuridicAuthorization;
use App\Http\Workflows\Stages\OpinionSignature;
use App\Http\Workflows\Stages\SendUserDocuments;
use App\Http\Workflows\Stages\UploadDocuments;
use App\Http\Workflows\Workflow;
use App\Models\WorkflowRequest;

class SocialReasonChange extends Workflow
{
    public function __construct(WorkflowRequest $workflowRequest)
    {
        parent::__construct($workflowRequest);
    }

    public function setStages(): void
    {
        $this->stages = [
            new UploadDocuments($this->workflowRequest),
            new DocumentsReview($this->workflowRequest),
            new AuthorizationDocuments($this->workflowRequest),
            new JuridicAuthorization($this->workflowRequest),
            new OpinionSignature($this->workflowRequest),
            new DirectionSignature($this->workflowRequest),
            new SendUserDocuments($this->workflowRequest)
        ];
    }
}
