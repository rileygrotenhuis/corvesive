<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\Paystub;
use App\Models\Saving;
use App\Models\User;
use App\Services\PayPeriods\AutoGenerateResourceService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    protected User $user;

    public function run(): void
    {
        $this->user = $this->createAdminUser();
        $this->createPaystubs();
        $this->createBills();
        $this->createBudgets();
        $this->createSavings();

        $this->createPayPeriods()->each(function ($payPeriod) {
            resolve(AutoGenerateResourceService::class)->autoGenerateAllPayPeriodResources($payPeriod, $this->user);
        });
    }

    protected function createAdminUser(): User
    {
        return User::factory()->create([
            'first_name' => 'Dev',
            'last_name' => 'Admin',
            'email' => 'dev@corvesive.com',
            'phone_number' => '8888888888',
            'password' => bcrypt('password'),
        ]);
    }

    protected function createPaystubs(): void
    {
        Paystub::factory()->for($this->user)->create([
            'issuer' => 'Company #1',
            'amount' => 350000,
        ]);

        Paystub::factory()->for($this->user)->create([
            'issuer' => 'Side Hustle',
            'amount' => 150000,
        ]);
    }

    protected function createBills(): void
    {
        Bill::factory()->for($this->user)->create([
            'issuer' => 'Apartment',
            'name' => 'Rent',
            'amount' => 125000,
            'due_date' => 1,
        ]);

        Bill::factory()->for($this->user)->create([
            'issuer' => 'City Utilities',
            'name' => 'Electricity',
            'amount' => 15000,
            'due_date' => 5,
        ]);

        Bill::factory()->for($this->user)->create([
            'issuer' => 'Evil Inc.',
            'name' => 'Auto Insurance',
            'amount' => 10000,
            'due_date' => 10,
        ]);

        Bill::factory()->for($this->user)->create([
            'issuer' => 'YouTube',
            'name' => 'Premium',
            'amount' => 1599,
            'due_date' => 15,
        ]);

        Bill::factory()->for($this->user)->create([
            'issuer' => 'Netflix',
            'name' => 'Membership',
            'amount' => 2599,
            'due_date' => 17,
        ]);

        Bill::factory()->for($this->user)->create([
            'issuer' => 'Big Muscles Gym',
            'name' => 'Membership',
            'amount' => 1500,
            'due_date' => 20,
        ]);
    }

    protected function createBudgets(): void
    {
        Budget::factory()->for($this->user)->create([
            'name' => 'Groceries',
            'amount' => 50000,
        ]);

        Budget::factory()->for($this->user)->create([
            'name' => 'Gas',
            'amount' => 15000,
        ]);

        Budget::factory()->for($this->user)->create([
            'name' => 'Entertainment',
            'amount' => 30000,
        ]);
    }

    protected function createSavings(): void
    {
        Saving::factory()->for($this->user)->create([
            'name' => 'General',
            'amount' => 25000,
        ]);

        Saving::factory()->for($this->user)->create([
            'name' => 'Vacation',
            'amount' => 10000,
        ]);
    }

    protected function createPayPeriods(): Collection
    {
        $a = PayPeriod::factory()->for($this->user)->create([
            'start_date' => Carbon::today()->firstOfMonth()->toDateString(),
            'end_date' => Carbon::create(
                Carbon::now()->year,
                Carbon::now()->month,
                15
            )->toDateString(),
        ]);

        $this->user->pay_period_id = $a->id;
        $this->user->save();

        $b = PayPeriod::factory()->for($this->user)->create([
            'start_date' => Carbon::create(
                Carbon::now()->year,
                Carbon::now()->month,
                15
            )->toDateString(),
            'end_date' => Carbon::today()->lastOfMonth()->toDateString(),
        ]);

        return collect([$a, $b]);
    }
}
