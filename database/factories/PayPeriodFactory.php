<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'start_date' => Carbon::now()->format('Y-m-d'),
            'end_date' => Carbon::now()->addDays(20)->format('Y-m-d'),
            'total_balance' => fake()->numberBetween(20000, 25000),
            'remaining_balance' => fake()->numberBetween(10000, 15000),
        ];
    }
}
