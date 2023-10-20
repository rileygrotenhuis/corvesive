<?php

namespace Database\Factories;

use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        $payPeriod = PayPeriod::factory()->create();

        return [
            'user_id' => User::factory(),
            'pay_period_id' => $payPeriod->id,
            'pay_period_bill_id' => PayPeriodBill::factory()->for($payPeriod)->create()->id,
            'type' => 'payment',
            'amount' => fake()->numberBetween(1000, 10000),
            'notes' => fake()->text(),
        ];
    }
}
