<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UpdateRolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Role::where('name', 'Operador')
            ->first()
            ->permissions()
            ->pluck('id')
            ->toArray();

        // REGISTRO
        $registrationAssistantRole = Role::create(['id' => 6, 'name' => 'Auxiliar Registro']);
        $registrationAssistantRole->syncPermissions($permissions);
        $registrationAssistants = Department::find(1)->users();
        foreach ($registrationAssistants->get() as $registrationAssistant) {
            $registrationAssistant->syncRoles($registrationAssistantRole);
        }
        $registrationAssistants->update([
            'type' => $registrationAssistantRole->id
        ]);

        $registrationManagerRole = Role::create( ['id' => 7, 'name' => 'Jefe Registro']);
        $registrationManagerRole->syncPermissions($permissions);
        Department::find(1)
            ->user?->syncRoles($registrationManagerRole)
            ->update([
                'type' => $registrationManagerRole->id
            ]);

        // JURÍDICO
        $juridicAssistantRole = Role::create( ['id' => 8, 'name' => 'Auxiliar Jurídico']);
        $juridicAssistantRole->syncPermissions($permissions);
        $juridicAssistants = Department::find(2)->users();
        foreach ($juridicAssistants->get() as $juridicAssistant) {
            $juridicAssistant->syncRoles($juridicAssistantRole);
        }
        $juridicAssistants->update([
            'type' => $juridicAssistantRole->id
        ]);

        $juridicManagerRole = Role::create( ['id' => 9, 'name' => 'Jefe Jurídico']);
        $juridicManagerRole->syncPermissions($permissions);
        Department::find(2)
            ->user?->syncRoles($juridicManagerRole)
            ->update([
                'type' => $juridicManagerRole->id
            ]);

        // Dirección
        $manager = Role::create( ['id' => 10, 'name' => 'Director']);
        $manager->syncPermissions($permissions);
        Department::find(3)
            ->user?->syncRoles($manager)
            ->update([
                'type' => $manager->id
            ]);


        Role::find(2)->delete();
    }
}
