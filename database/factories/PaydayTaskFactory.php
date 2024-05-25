<?php

namespace Database\Factories;

use App\Models\MonthlyExpense;
use App\Models\MonthlyPaystub;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaydayTaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'monthly_paystub_id' => MonthlyPaystub::factory(),
            'monthly_expense_id' => MonthlyExpense::factory(),
            'amount_in_cents' => fake()->numberBetween(1000, 10000),
        ];
    }
}
