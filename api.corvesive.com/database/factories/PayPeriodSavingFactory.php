<?php

namespace Database\Factories;

use App\Models\PayPeriod;
use App\Models\Saving;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodSavingFactory extends Factory
{
    public function definition()
    {
        return [
            'pay_period_id' => PayPeriod::factory(),
            'saving_id' => Saving::factory(),
            'amount' => fake()->numberBetween(10000, 100000),
        ];
    }
}
