<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\PayPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodBudgetFactory extends Factory
{
    public function definition()
    {
        $startingAmount = fake()->numberBetween(10000, 100000);

        return [
            'pay_period_id' => PayPeriod::factory(),
            'budget_id' => Budget::factory(),
            'total_balance' => $startingAmount,
            'remaining_balance' => $startingAmount,
        ];
    }
}
