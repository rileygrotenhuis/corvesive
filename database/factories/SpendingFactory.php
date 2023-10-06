<?php

namespace Database\Factories;

use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpendingFactory extends Factory
{
    public function definition(): array
    {
        $startingAmount = fake()->numberBetween(10000, 100000);

        return [
            'user_id' => User::factory(),
            'pay_period_id' => PayPeriod::factory(),
            'total_balance' => $startingAmount,
            'remaining_balance' => $startingAmount,
        ];
    }
}
