<?php

namespace App\Services\PayPeriods;

use App\Models\Bill;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\Paystub;
use App\Models\User;
use Carbon\Carbon;

class AutoGenerateResourceService
{
    public function autoGenerateAllPayPeriodResources(PayPeriod $payPeriod, User $user): void
    {
        $this->autoGeneratePayPeriodPaystubs($payPeriod, $user);
        $this->autoGeneratePayPeriodBills($payPeriod, $user);
        $this->autoGeneratePayPeriodBudgets($payPeriod, $user);
    }

    protected function autoGeneratePayPeriodPaystubs(PayPeriod $payPeriod, User $user): void
    {
        $paystubs = Paystub::where('user_id', $user->id)->get();

        $paystubs->each(function ($paystub) use ($payPeriod) {
            resolve(PayPeriodPaystubService::class)
                ->addPaystubToPayPeriod(
                    $payPeriod,
                    $paystub,
                    $paystub->amount * $payPeriod->monthCoveragePercentage()
                );
        });
    }

    protected function autoGeneratePayPeriodBills(PayPeriod $payPeriod, User $user): void
    {
        $bills = Bill::where('user_id', $user->id)
            ->where('due_date', '>=', Carbon::parse($payPeriod->start_date)->day)
            ->where('due_date', '<=', Carbon::parse($payPeriod->end_date)->day)
            ->get();

        $bills->each(function ($bill) use ($payPeriod) {
            resolve(PayPeriodBillService::class)
                ->addBillToPayPeriod(
                    $payPeriod->id,
                    $bill->id,
                    $bill->amount,
                    $this->getPayPeriodBillDueDate($bill->due_date),
                    $bill->is_automatic
                );
        });
    }

    protected function autoGeneratePayPeriodBudgets(PayPeriod $payPeriod, User $user): void
    {
        $budgets = Budget::where('user_id', $user->id)->get();

        $budgets->each(function ($budget) use ($payPeriod) {
            resolve(PayPeriodBudgetService::class)
                ->addBudgetToPayPeriod(
                    $payPeriod,
                    $budget,
                    $budget->amount * $payPeriod->monthCoveragePercentage()
                );
        });
    }

    protected function getPayPeriodBillDueDate(string $dueDate): Carbon
    {
        return Carbon::create(
            Carbon::now()->year,
            Carbon::now()->month,
            $dueDate
        );
    }
}
