<?php

namespace Database\Factories;

use App\Models\MonthlyBudget;
use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodBudgetFactory extends Factory
{
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'pay_period_id' => PayPeriod::factory()->for($user),
            'budget_id' => MonthlyBudget::factory()->for($user),
            'total_balance_in_cents' => fake()->numberBetween(0, 1000000),
        ];
    }
}
