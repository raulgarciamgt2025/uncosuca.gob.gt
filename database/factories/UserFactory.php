<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName(),
            'email' => $this->faker->unique->email(),
            'cui' => $this->faker->numberBetween(1000000000000, 9000000000000),
            'nit' => $this->faker->numberBetween(100000000, 900000000),
            'type' => $this->faker->numberBetween(1, 5),
            'email_verified_at' => now(),
            'password' => \Hash::make('admin'),
            'remember_token' => Str::random(10),
            'active' => $this->faker->boolean(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
