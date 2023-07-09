<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodFactory extends Factory
{
    public function definition(): array
    {
        $totalBalance = fake()->numberBetween(20000, 25000);

        return [
            'user_id' => User::factory(),
            'start_date' => Carbon::now()->format('Y-m-d'),
            'end_date' => Carbon::now()->addDays(20)->format('Y-m-d'),
            'total_balance' => $totalBalance,
            'remaining_balance' => $totalBalance,
        ];
    }
}
