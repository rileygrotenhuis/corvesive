<?php

namespace Database\Factories;

use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    public function definition(): array
    {
        $amount = fake()->numberBetween(20000, 25000);

        return [
            'user_id' => User::factory(),
            'pay_period_id' => PayPeriod::factory(),
            'name' => fake()->randomElement([
                'Spending',
                'Groceries',
                'Gas',
            ]),
            'amount' => $amount,
            'remaining_balance' => $amount,
        ];
    }
}
