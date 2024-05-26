<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'amount' => $this->faker->numberBetween(10000, 50000),
        ];
    }
}
