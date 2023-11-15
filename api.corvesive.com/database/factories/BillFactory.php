<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'issuer' => fake()->name(),
            'name' => fake()->name(),
            'amount' => fake()->numberBetween(10000, 100000),
            'due_date' => fake()->numberBetween(1, 20),
            'is_automatic' => false,
            'notes' => fake()->text(),
        ];
    }
}
