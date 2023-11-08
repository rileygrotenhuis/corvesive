<?php

namespace Database\Factories;

use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodMetricFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'pay_period_id' => PayPeriod::factory(),
        ];
    }
}
