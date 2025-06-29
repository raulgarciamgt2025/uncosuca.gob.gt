<?php

namespace Database\Seeders;

use App\Models\StateStage;
use App\Models\Workflow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddTypeStage extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workflows = Workflow::all();
        foreach ($workflows as $workflow) {
            $steps =  json_decode($workflow->steps, true);
            $stepsWithType = [];
            foreach ($steps as $key => $step) {
                $step['type'] = $key + 1;
                $stepsWithType[] = $step;
            }
            $workflow->steps = json_encode($stepsWithType);
            $workflow->save();
        }

        $stages =  StateStage::all();
        foreach ($stages as $stage) {
            $stage->update([
                'type' => $stage->stage + 1,
            ]);
        }
    }
}
