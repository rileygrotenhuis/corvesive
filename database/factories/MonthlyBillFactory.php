<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonthlyBillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'issuer' => fake()->company(),
            'name' => fake()->name(),
            'amount_in_cents' => fake()->numberBetween(1000, 100000),
            'due_day_of_month' => fake()->numberBetween(1, 28),
            'notes' => fake()->sentence(),
        ];
    }
}
