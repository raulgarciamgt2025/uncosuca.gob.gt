<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkflowRequest;

class WorkflowRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkflowRequest::factory()
            ->count(5)
            ->create();
    }
}
