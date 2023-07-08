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
            'name' => fake()->randomElement([
                'Rent',
                'Utilities',
                'Insurance'
            ]),
            'amount' => fake()->numberBetween(5000, 25000),
        ];
    }
}
