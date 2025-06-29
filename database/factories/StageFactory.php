<?php

namespace Database\Factories;

use App\Models\Stage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'json' => $this->faker->text(),
            'assign_level' => $this->faker->randomNumber(0),
            'workflow_id' => \App\Models\Workflow::factory(),
        ];
    }
}
