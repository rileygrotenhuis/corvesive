<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\PayPeriod;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodBillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pay_period_id' => PayPeriod::factory(),
            'bill_id' => Bill::factory(),
            'amount' => fake()->numberBetween(50000, 100000),
            'has_payed' => false,
            'due_date' => Carbon::today()->toDateString(),
            'is_automatic' => false,
        ];
    }
}
