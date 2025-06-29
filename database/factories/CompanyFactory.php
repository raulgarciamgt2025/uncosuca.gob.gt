<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'company_data' => $this->faker->words(),
            'company_type' => $this->faker->randomNumber(),
            'status' => $this->faker->randomNumber(),
            'payment_status' => $this->faker->randomNumber(),
            'workflows_history' => $this->faker->words(),
            'user_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
