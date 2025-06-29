<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkflowRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkflowRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the workflowRequest can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list workflow_requests');
    }

    /**
     * Determine whether the workflowRequest can view the model.
     */
    public function view(User $user, WorkflowRequest $model): bool
    {
        return $user->hasPermissionTo('view workflow_requests');
    }

    /**
     * Determine whether the workflowRequest can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create workflow_requests');
    }

    /**
     * Determine whether the workflowRequest can update the model.
     */
    public function update(User $user, WorkflowRequest $model): bool
    {
        return $user->hasPermissionTo('update workflow_requests');
    }

    /**
     * Determine whether the workflowRequest can delete the model.
     */
    public function delete(User $user, WorkflowRequest $model): bool
    {
        return $user->hasPermissionTo('delete workflow_requests');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete workflow_requests');
    }

    /**
     * Determine whether the workflowRequest can restore the model.
     */
    public function restore(User $user, WorkflowRequest $model): bool
    {
        return false;
    }

    /**
     * Determine whether the workflowRequest can permanently delete the model.
     */
    public function forceDelete(User $user, WorkflowRequest $model): bool
    {
        return false;
    }
}
