<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\PayPeriodPaystub;
use App\Models\Paystub;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    protected User $adminUser;

    protected Paystub $paystub;

    protected Collection $budgets;

    protected Collection $bills;

    public function run(): void
    {
        // Admin User
        $this->adminUser = User::factory()->create([
            'first_name' => 'Dev',
            'last_name' => 'Admin',
            'email' => 'admin@corvesive.com',
            'phone_number' => '8888888888',
            'password' => bcrypt('password'),
        ]);

        // Paystub
        $this->paystub = Paystub::factory()
            ->for($this->adminUser)
            ->create();

        // Monthly Budgets
        $this->budgets = Budget::factory(3)
            ->for($this->adminUser)
            ->create();

        // Monthly Bills
        $this->bills = Bill::factory(3)
            ->for($this->adminUser)
            ->create();

        // Previous Pay Period
        $this->addExpensesToPayPeriod(
            $this->createPayPeriod(
                Carbon::today()->subDays(21)->toDateString(),
                Carbon::today()->subDays(1)->toDateString(),
            )
        );

        // Current Pay Period
        $this->addExpensesToPayPeriod(
            $this->createPayPeriod(
                Carbon::today()->subDays()->toDateString(),
                Carbon::today()->subDays(20)->toDateString(),
            )
        );

        // Future Pay Period
        $this->addExpensesToPayPeriod(
            $this->createPayPeriod(
                Carbon::today()->subDays(21)->toDateString(),
                Carbon::today()->subDays(41)->toDateString(),
            )
        );
    }

    protected function createPayPeriod(string $startDate, string $endDate): PayPeriod
    {
        return PayPeriod::factory()
            ->for($this->adminUser)
            ->create([
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);
    }

    protected function addExpensesToPayPeriod(PayPeriod $payPeriod): void
    {
        $this->addPaystubToPayPeriod($payPeriod);
        $this->addBudgetsToPayPeriod($payPeriod);
        $this->addBillsToPayPeriod($payPeriod);
    }

    protected function addPaystubToPayPeriod(PayPeriod $payPeriod): void
    {
        PayPeriodPaystub::factory()
            ->for($payPeriod)
            ->for($this->paystub);
    }

    protected function addBudgetsToPayPeriod(PayPeriod $payPeriod): void
    {
        foreach ($this->budgets as $budget) {
            PayPeriodBudget::factory()
                ->for($payPeriod)
                ->for($budget)
                ->create([
                    'total_balance' => $budget->amount,
                    'remaining_balance' => $budget->amount,
                ]);
        }
    }

    protected function addBillsToPayPeriod(PayPeriod $payPeriod): void
    {
        foreach ($this->bills as $bill) {
            PayPeriodBill::factory()
                ->for($payPeriod)
                ->for($bill)
                ->create([
                    'amount' => $bill->amount,
                    'has_payed' => false,
                ]);
        }
    }
}
