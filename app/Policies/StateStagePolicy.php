<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StateStage;
use Illuminate\Auth\Access\HandlesAuthorization;

class StateStagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the stateStage can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list state_stages');
    }

    /**
     * Determine whether the stateStage can view the model.
     */
    public function view(User $user, StateStage $model): bool
    {
        return $user->hasPermissionTo('view state_stages');
    }

    /**
     * Determine whether the stateStage can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create state_stages');
    }

    /**
     * Determine whether the stateStage can update the model.
     */
    public function update(User $user, StateStage $model): bool
    {
        return $user->hasPermissionTo('update state_stages');
    }

    /**
     * Determine whether the stateStage can delete the model.
     */
    public function delete(User $user, StateStage $model): bool
    {
        return $user->hasPermissionTo('delete state_stages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete state_stages');
    }

    /**
     * Determine whether the stateStage can restore the model.
     */
    public function restore(User $user, StateStage $model): bool
    {
        return false;
    }

    /**
     * Determine whether the stateStage can permanently delete the model.
     */
    public function forceDelete(User $user, StateStage $model): bool
    {
        return false;
    }
}
