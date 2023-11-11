<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Budget;
use App\Models\Paystub;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class GardenSeeder extends Seeder
{
    protected User $user;

    protected Collection $paystubs;

    protected Collection $bills;

    protected Collection $budgets;

    public function run(): void
    {
        $this->createAdminUser();
        $this->paystubs = $this->createPaystubs();
        $this->bills = $this->createBills();
        $this->budgets = $this->createBudgets();
    }

    protected function createAdminUser(): void
    {
        $this->user = User::factory()->create([
            'first_name' => 'Dev',
            'last_name' => 'Admin',
            'email' => 'dev@corvesive.com',
            'phone_number' => '8888888888',
            'password' => bcrypt('password'),
        ]);
    }

    protected function createPaystubs(): Collection
    {
        $x = Paystub::factory()->for($this->user)->create([
            'issuer' => 'Company #1',
            'amount' => 350000,
        ]);

        $y = Paystub::factory()->for($this->user)->create([
            'issuer' => 'Side Hustle',
            'amount' => 150000,
        ]);

        return collect([$x, $y]);
    }

    protected function createBills(): Collection
    {
        $a = Bill::factory()->for($this->user)->create([
            'issuer' => 'Apartment',
            'name' => 'Rent',
            'amount' => 125000,
            'due_date' => 1,
        ]);

        $b = Bill::factory()->for($this->user)->create([
            'issuer' => 'City Utilities',
            'name' => 'Electricity',
            'amount' => 15000,
            'due_date' => 5,
        ]);

        $c = Bill::factory()->for($this->user)->create([
            'issuer' => 'Evil Inc.',
            'name' => 'Auto Insurance',
            'amount' => 10000,
            'due_date' => 10,
        ]);

        $d = Bill::factory()->for($this->user)->create([
            'issuer' => 'YouTube',
            'name' => 'Premium',
            'amount' => 1599,
            'due_date' => 15,
        ]);

        $e = Bill::factory()->for($this->user)->create([
            'issuer' => 'Netflix',
            'name' => 'Membership',
            'amount' => 2599,
            'due_date' => 17,
        ]);

        $f = Bill::factory()->for($this->user)->create([
            'issuer' => 'Big Muscles Gym',
            'name' => 'Membership',
            'amount' => 1500,
            'due_date' => 20,
        ]);

        return collect([$a, $b, $c, $d, $d, $f]);
    }

    protected function createBudgets(): Collection
    {
        $a = Budget::factory()->for($this->user)->create([
            'name' => 'Groceries',
            'amount' => 50000,
        ]);

        $b = Budget::factory()->for($this->user)->create([
            'name' => 'Gas',
            'amount' => 15000,
        ]);

        $c = Budget::factory()->for($this->user)->create([
            'name' => 'Entertainment',
            'amount' => 30000,
        ]);

        return collect([$a, $b, $c]);
    }
}
