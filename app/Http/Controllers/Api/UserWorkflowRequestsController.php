<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkflowRequestResource;
use App\Http\Resources\WorkflowRequestCollection;

class UserWorkflowRequestsController extends Controller
{
    public function index(
        Request $request,
        User $user
    ): WorkflowRequestCollection {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $workflowRequests = $user
            ->workflowRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new WorkflowRequestCollection($workflowRequests);
    }

    public function store(Request $request, User $user): WorkflowRequestResource
    {
        $this->authorize('create', WorkflowRequest::class);

        $validated = $request->validate([
            'key' => ['required', 'max:255', 'string'],
            'type' => ['required', 'numeric'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'state' => ['required', 'numeric'],
            'workflow_id' => ['required', 'exists:workflows,id'],
        ]);

        $workflowRequest = $user->workflowRequests()->create($validated);

        return new WorkflowRequestResource($workflowRequest);
    }
}
