<?php

namespace Database\Factories;

use App\Models\PayPeriod;
use App\Models\Paystub;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodPaystubFactory extends Factory
{
    public function definition()
    {
        return [
            'pay_period_id' => PayPeriod::factory(),
            'paystub_id' => Paystub::factory(),
            'amount' => fake()->numberBetween(5000, 25000),
        ];
    }
}
