<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonthlyBudgetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'total_balance_in_cents' => fake()->numberBetween(100000, 1000000),
            'notes' => fake()->sentence(),
        ];
    }
}
