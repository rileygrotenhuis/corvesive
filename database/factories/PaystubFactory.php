<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaystubFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'issuer' => fake()->company(),
            'amount_in_cents' => fake()->numberBetween(1000, 100000),
            'recurrence_rate' => 'weekly',
            'recurrence_interval_one' => fake()->numberBetween(1, 7),
            'recurrence_interval_two' => fake()->numberBetween(1, 7),
        ];
    }
}
