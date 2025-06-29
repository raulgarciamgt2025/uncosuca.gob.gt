<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;

class CompanyPolicy
{
    public function viewCompanies(User $user): bool
    {
        $result = false;
        if ($user->hasPermissionTo('Lista empresas')) {
            $departments = Department::where('departments.id', 1)
                ->join('users', 'departments.manager_id', 'users.id')->pluck('users.id')->toArray();
            $result = in_array(auth()->id(), $departments) || auth()->user()->type == 3;
        }
        return $result;
    }
}
