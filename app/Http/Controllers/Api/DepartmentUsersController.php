<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;

class DepartmentUsersController extends Controller
{
    public function index(
        Request $request,
        Department $department
    ): UserCollection {
        $this->authorize('view', $department);

        $search = $request->get('search', '');

        $users = $department
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(
        Request $request,
        Department $department,
        User $user
    ): Response {
        $this->authorize('update', $department);

        $department->users()->syncWithoutDetaching([$user->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Department $department,
        User $user
    ): Response {
        $this->authorize('update', $department);

        $department->users()->detach($user);

        return response()->noContent();
    }
}
