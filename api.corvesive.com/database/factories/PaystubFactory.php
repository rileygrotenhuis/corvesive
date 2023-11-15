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
            'issuer' => fake()->name(),
            'type' => 'General',
            'amount' => fake()->numberBetween(5000, 25000),
            'notes' => fake()->text(),
        ];
    }
}
