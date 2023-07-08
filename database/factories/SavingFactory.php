<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SavingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement([
                'General',
                '401K',
                'Emergency',
            ]),
            'amount' => fake()->numberBetween(5000, 25000),
        ];
    }
}
