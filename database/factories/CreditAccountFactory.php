<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditAccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'issuer' => fake()->name(),
            'name' => fake()->name(),
            'type' => fake()->randomElement([
                'visa',
                'mastercard',
                'amex',
            ]),
            'credit_limit' => fake()->numberBetween(100000, 1000000),
            'interest_rate' => fake()->numberBetween(0.1, 0.3),
            'annual_fee' => fake()->numberBetween(10000, 30000),
        ];
    }
}
