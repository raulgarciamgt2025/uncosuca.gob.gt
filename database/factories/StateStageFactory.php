<?php

namespace Database\Factories;

use App\Models\StateStage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StateStageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StateStage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => $this->faker->randomNumber(0),
            'json' => $this->faker->text(),
            'workflow_request_id' => \App\Models\WorkflowRequest::factory(),
            'user_id' => \App\Models\User::factory(),
            'stage_id' => \App\Models\Stage::factory(),
        ];
    }
}
