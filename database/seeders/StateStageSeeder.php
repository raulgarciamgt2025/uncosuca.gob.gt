<?php

namespace Database\Seeders;

use App\Models\StateStage;
use Illuminate\Database\Seeder;

class StateStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StateStage::factory()
            ->count(5)
            ->create();
    }
}
