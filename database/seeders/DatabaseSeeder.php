<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Paystub;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->adminUser();

        /**
         * Creates 1000 test users and generates paystubs
         * and monthly expenses for each of those users.
         */
        $user = User::factory(1000)->create();
        $user->each(function (User $user) {
            $paystub = Paystub::factory()->for($user)->create([
                'recurrence_rate' => 'monthly',
                'recurrence_interval_one' => 1,
            ]);

            $paystub->generateFutureExpenses();

            $expenses = Expense::factory(10)->for($user)->create();

            $expenses->each(function (Expense $expense) {
                $expense->generateFutureExpenses();
            });
        });
    }

    /**
     * Seeds the database with an admin user
     * that can be used for development.
     */
    protected function adminUser(): void
    {
        /** Admin User */
        $user = User::factory()->create([
            'first_name' => 'Dev',
            'last_name' => 'User',
            'email' => 'dev@corvesive.com',
            'password' => bcrypt('password'),
        ]);

        /** Main Paystub */
        $paystub = Paystub::factory()->for($user)->create([
            'issuer' => 'Corvesive',
            'amount_in_cents' => 100000,
            'recurrence_rate' => 'monthly',
            'recurrence_interval_one' => 1,
        ]);

        /**
         * Generate monthly paystubs for the
         * next 12 months.
         */
        $paystub->generateFutureExpenses();

        /** Expenses */
        $expenses = Expense::factory(10)->for($user)->create();

        /**
         * Generate monthly expenses for the
         * next 12 months.
         */
        $expenses->each(function (Expense $expense) {
            $expense->generateFutureExpenses();
        });
    }
}
