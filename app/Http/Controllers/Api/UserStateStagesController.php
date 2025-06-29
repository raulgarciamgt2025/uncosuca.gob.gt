<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StateStageResource;
use App\Http\Resources\StateStageCollection;

class UserStateStagesController extends Controller
{
    public function index(Request $request, User $user): StateStageCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $stateStages = $user
            ->stateStages()
            ->search($search)
            ->latest()
            ->paginate();

        return new StateStageCollection($stateStages);
    }

    public function store(Request $request, User $user): StateStageResource
    {
        $this->authorize('create', StateStage::class);

        $validated = $request->validate([
            'workflow_request_id' => [
                'required',
                'exists:workflow_requests,id',
            ],
            'state' => ['required', 'numeric'],
            'json' => ['nullable', 'max:255', 'string'],
            'stage_id' => ['required', 'exists:stages,id'],
        ]);

        $stateStage = $user->stateStages()->create($validated);

        return new StateStageResource($stateStage);
    }
}
