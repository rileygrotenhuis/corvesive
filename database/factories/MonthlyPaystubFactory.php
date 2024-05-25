<?php

namespace Database\Factories;

use App\Models\Paystub;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonthlyPaystubFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'paystub_id' => Paystub::factory(),
            'year' => 2024,
            'month' => fake()->numberBetween(1, 12),
            'pay_day' => fake()->date(),
            'amount_in_cents' => fake()->numberBetween(1000, 100000),
        ];
    }
}
