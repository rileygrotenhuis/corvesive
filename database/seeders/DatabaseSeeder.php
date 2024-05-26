<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Budget;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Dev Admin',
            'email' => 'dev@dev.com',
            'password' => '$2y$10$4EGb48ZZW3GWWL6Fw1JbLuIYhYruQTG8M23xquQZ3hQk7t.KhuAnO',
            'total' => 250000,
        ]);

        foreach (['Groceries', 'Gas', 'Spending'] as $budget) {
            Budget::factory()->for($user)->create([
                'name' => $budget,
            ]);
        }

        foreach (['Rent', 'Utilities', 'Insurance'] as $bill) {
            Bill::factory()->for($user)->create([
                'name' => $bill,
            ]);
        }

        foreach (['401K', 'General'] as $saving) {
            Saving::factory()->for($user)->create([
                'name' => $saving,
            ]);
        }
    }
}
