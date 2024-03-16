<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepositFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'amount_in_cents' => $this->faker->numberBetween(100, 100000),
            'notes' => $this->faker->sentence,
        ];
    }
}
