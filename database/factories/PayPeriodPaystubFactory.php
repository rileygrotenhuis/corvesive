<?php

namespace Database\Factories;

use App\Models\PayPeriod;
use App\Models\Paystub;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodPaystubFactory extends Factory
{
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'pay_period_id' => PayPeriod::factory()->for($user),
            'paystub_id' => Paystub::factory()->for($user),
            'amount_in_cents' => $this->faker->numberBetween(1000, 100000),
        ];
    }
}
