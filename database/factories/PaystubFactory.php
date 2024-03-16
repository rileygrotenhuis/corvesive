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
            'amount_in_cents' => fake()->numberBetween(100000, 1000000),
            'notes' => fake()->sentence(),
        ];
    }
}
