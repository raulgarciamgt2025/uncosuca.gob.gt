<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Department;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the department can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Lista departamentos');
    }

    /**
     * Determine whether the department can view the model.
     */
    public function view(User $user, Department $model): bool
    {
        return $user->hasPermissionTo('Ver departamentos');
    }

    /**
     * Determine whether the department can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Crear departamentos');
    }

    /**
     * Determine whether the department can update the model.
     */
    public function update(User $user, Department $model): bool
    {
        return $user->hasPermissionTo('Actualizar departamentos');
    }

    /**
     * Determine whether the department can delete the model.
     */
    public function delete(User $user, Department $model): bool
    {
        return $user->hasPermissionTo('Eliminar departamentos');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('Eliminar departamentos');
    }

    /**
     * Determine whether the department can restore the model.
     */
    public function restore(User $user, Department $model): bool
    {
        return false;
    }

    /**
     * Determine whether the department can permanently delete the model.
     */
    public function forceDelete(User $user, Department $model): bool
    {
        return false;
    }
}
