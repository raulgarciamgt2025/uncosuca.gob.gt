<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workflow;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkflowPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the workflow can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list workflows');
    }

    /**
     * Determine whether the workflow can view the model.
     */
    public function view(User $user, Workflow $model): bool
    {
        return $user->hasPermissionTo('view workflows');
    }

    /**
     * Determine whether the workflow can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create workflows');
    }

    /**
     * Determine whether the workflow can update the model.
     */
    public function update(User $user, Workflow $model): bool
    {
        return $user->hasPermissionTo('update workflows');
    }

    /**
     * Determine whether the workflow can delete the model.
     */
    public function delete(User $user, Workflow $model): bool
    {
        return $user->hasPermissionTo('delete workflows');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete workflows');
    }

    /**
     * Determine whether the workflow can restore the model.
     */
    public function restore(User $user, Workflow $model): bool
    {
        return false;
    }

    /**
     * Determine whether the workflow can permanently delete the model.
     */
    public function forceDelete(User $user, Workflow $model): bool
    {
        return false;
    }
}
