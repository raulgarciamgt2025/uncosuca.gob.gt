<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\WorkflowRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkflowRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkflowRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->text(191),
            'type' => $this->faker->randomNumber(0),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'state' => $this->faker->randomNumber(0),
            'request_user_id' => \App\Models\User::factory(),
            'workflow_id' => \App\Models\Workflow::factory(),
        ];
    }
}
