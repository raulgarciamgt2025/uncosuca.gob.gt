<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentCollection;

class UserDepartmentsController extends Controller
{
    public function index(Request $request, User $user): DepartmentCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $departments = $user
            ->departments()
            ->search($search)
            ->latest()
            ->paginate();

        return new DepartmentCollection($departments);
    }

    public function store(
        Request $request,
        User $user,
        Department $department
    ): Response {
        $this->authorize('update', $user);

        $user->departments()->syncWithoutDetaching([$department->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        User $user,
        Department $department
    ): Response {
        $this->authorize('update', $user);

        $user->departments()->detach($department);

        return response()->noContent();
    }
}
