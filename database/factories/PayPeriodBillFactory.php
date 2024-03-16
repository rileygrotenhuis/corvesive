<?php

namespace Database\Factories;

use App\Models\MonthlyBill;
use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodBillFactory extends Factory
{
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'pay_period_id' => PayPeriod::factory()->for($user),
            'bill_id' => MonthlyBill::factory()->for($user),
            'amount_in_cents' => $this->faker->numberBetween(1000, 100000),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
