<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodFactory extends Factory
{
    public function definition(): array
    {
        $startDate = Carbon::now();

        return [
            'user_id' => User::factory(),
            'start_date' => $startDate->toDateString(),
            'end_date' => $startDate->addDays(14)->toDateString(),
        ];
    }
}
