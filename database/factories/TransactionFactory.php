<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'transactionable_type' => Bill::class,
            'transactionable_id' => Bill::factory(),
            'amount' => fake()->numberBetween(100, 10000),
        ];
    }
}
