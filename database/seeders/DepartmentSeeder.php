<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Registro',
                'description' => 'Departamento de registro',
                'active' => 1,
                'manager_id' => 1
            ],
            [
                'name' => 'Jurídico',
                'description' => 'Departamento jurídico',
                'active' => 1,
                'manager_id' => 1
            ],
            [
                'name' => 'Dirección',
                'description' => 'Dirección general',
                'active' => 1,
                'manager_id' => 1
            ]
        ];
        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
