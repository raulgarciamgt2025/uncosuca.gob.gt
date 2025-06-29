<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'Lista mis solicitudes']);
        Permission::create(['name' => 'Crear solicitudes']);
        Permission::create(['name' => 'Actualizar solicitudes']);
        Permission::create(['name' => 'Eliminar solicitudes']);

        // Create admin exclusive permissions
        Permission::create(['name' => 'Lista solicitudes asignadas']);

        Permission::create(['name' => 'Lista departamentos']);
        Permission::create(['name' => 'Ver departamentos']);
        Permission::create(['name' => 'Crear departamentos']);
        Permission::create(['name' => 'Actualizar departamentos']);
        Permission::create(['name' => 'Eliminar departamentos']);

        Permission::create(['name' => 'Lista roles']);
        Permission::create(['name' => 'Ver roles']);
        Permission::create(['name' => 'Crear roles']);
        Permission::create(['name' => 'Actualizar roles']);
        Permission::create(['name' => 'Eliminar roles']);

        Permission::create(['name' => 'Lista permisos']);
        Permission::create(['name' => 'Ver permisos']);
        Permission::create(['name' => 'Crear permisos']);
        Permission::create(['name' => 'Actualizar permisos']);
        Permission::create(['name' => 'Eliminar permisos']);

        Permission::create(['name' => 'Lista usuarios']);
        Permission::create(['name' => 'Ver usuarios']);
        Permission::create(['name' => 'Crear usuarios']);
        Permission::create(['name' => 'Actualizar usuarios']);
        Permission::create(['name' => 'Eliminar usuarios']);
        Permission::create(['name' => 'Mis quejas']);
        Permission::create(['name' => 'Lista quejas']);
        Permission::create(['name' => 'Dashboard']);
        Permission::create(['name' => 'Lista empresas']);
        Permission::create(['name' => 'Lista canales']);
        Permission::create(['name' => 'Lista categorías']);
        Permission::create(['name' => 'Lista supervisiones']);
        Permission::create(['name' => 'Lista pagos']);
        Permission::create(['name' => 'Mis pagos']);
        Permission::create(['name' => 'Mis supervisiones']);
        Permission::create(['name' => 'Mapa privado']);
        Permission::create(['name' => 'Monitoreo']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        Role::create(['id' => 1,'name' => 'Solicitante']);
        $superAdminRole = Role::create(['id' => 3, 'name' => 'Administrador']);
        Role::create(['id' => 4, 'name' => 'Supervisor']);
        Role::create(['id' => 5, 'name' => 'Jefe de supervisión']);
        $superAdminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        $user?->assignRole($superAdminRole);
    }
}
