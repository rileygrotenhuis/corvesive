<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement([
                'Spending',
                'Groceries',
                'Gas',
            ]),
            'amount' => fake()->numberBetween(20000, 25000),
            'remaining_balance' => fake()->numberBetween(10000, 15000),
        ];
    }
}
