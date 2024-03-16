<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'transactionable_type' => $this->faker->randomElement([
                'App\Models\PayPeriodBill',
                'App\Models\PayPeriodBudget',
                'App\Models\PayPeriodSaving',
            ]),
            'transactionable_id' => $this->faker->numberBetween(1, 100),
            'amount_in_cents' => $this->faker->numberBetween(100, 100000),
        ];
    }
}
