<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'issuer' => $this->faker->company,
            'name' => $this->faker->word,
            'amount_in_cents' => $this->faker->randomNumber(5),
            'due_day_of_month' => $this->faker->numberBetween(1, 28),
        ];
    }
}
