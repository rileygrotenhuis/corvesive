<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonthlySavingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'amount_in_cents' => fake()->numberBetween(1000, 100000),
            'notes' => fake()->sentence(),
        ];
    }
}
