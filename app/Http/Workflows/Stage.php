<?php

namespace App\Http\Workflows;

use App\Models\Department;
use App\Models\User;
use App\Models\WorkflowRequest;
use View;

interface Stage
{
    public function prepare(): bool;

    public function process();

    public function complete();

    public function getAssignType(): string;

    public function getAssignId(): ?int;

    public function getMessage(): string;
}
