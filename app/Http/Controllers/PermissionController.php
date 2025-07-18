<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index(Request $request): View
    {
        $this->authorize('Lista permisos');

        $search = $request->get('search', '');
        $permissions = Permission::where('name', 'like', "%{$search}%")->paginate(10);

        return view('app.permissions.index')
            ->with('permissions', $permissions)
            ->with('search', $search);
    }

    /**
    * Show the form for creating a new resource.
    */
    public function create(): View
    {
        $this->authorize('Crear permisos');

        $roles = Role::all();
        return view('app.permissions.create')->with('roles', $roles);
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request): RedirectResponse
    {

        $this->authorize('Crear permisos');

        $data = $this->validate($request, [
            'name' => 'required|max:64',
            'roles' => 'array'
        ]);

        $permission = Permission::create($data);

        $roles = Role::find($request->roles);
        $permission->syncRoles($roles);

        return redirect()
            ->route('permissions.edit', $permission->id)
            ->withSuccess(__('crud.common.created'));
    }

    /**
    * Display the specified resource.
    */
    public function show(Permission $permission): View
    {
        $this->authorize('Ver permisos');

        return view('app.permissions.show')->with('permission', $permission);
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Permission $permission): View
    {
        $this->authorize('Actualizar permisos');

        $roles = Role::get();

        return view('app.permissions.edit')
            ->with('permission', $permission)
            ->with('roles', $roles);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $this->authorize('Actualizar permisos');

        $data = $this->validate($request, [
            //'name' => 'required|max:40',
            'roles' => 'array'
        ]);

        $permission->update($data);

        $roles = Role::find($request->roles);
        $permission->syncRoles($roles);

        return redirect()
            ->route('permissions.edit', $permission->id)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Permission $permission): RedirectResponse
    {
        $this->authorize('Eliminar permisos');

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
