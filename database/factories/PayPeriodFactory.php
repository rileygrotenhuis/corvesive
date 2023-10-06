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
            'start_date' => Carbon::today()->toDateString(),
            'end_date' => Carbon::today()->addDays(20)->toDateString(),
        ];
    }
}
