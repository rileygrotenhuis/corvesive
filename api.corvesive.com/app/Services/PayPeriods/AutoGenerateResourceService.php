<?php

namespace App\Services\PayPeriods;

use App\Models\Bill;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\Paystub;
use Carbon\Carbon;

class AutoGenerateResourceService
{
    public function autoGenerateAllPayPeriodResources(PayPeriod $payPeriod): void
    {
        $this->autoGeneratePayPeriodPaystubs($payPeriod);
        $this->autoGeneratePayPeriodBills($payPeriod);
        $this->autoGeneratePayPeriodBudgets($payPeriod);
    }

    protected function autoGeneratePayPeriodPaystubs(PayPeriod $payPeriod): void
    {
        $paystubs = Paystub::where('user_id', auth()->user()->id)->get();

        $paystubs->each(function ($paystub) use ($payPeriod) {
            resolve(PayPeriodPaystubService::class)
                ->addPaystubToPayPeriod(
                    $payPeriod,
                    $paystub,
                    $paystub->amount * $payPeriod->monthCoveragePercentage()
                );
        });
    }

    protected function autoGeneratePayPeriodBills(PayPeriod $payPeriod): void
    {
        $bills = Bill::where('user_id', auth()->user()->id)
            ->where('due_date', '>=', Carbon::parse($payPeriod->start_date)->day)
            ->where('due_date', '<=', Carbon::parse($payPeriod->end_date)->day)
            ->get();

        $bills->each(function ($bill) use ($payPeriod) {
            resolve(PayPeriodBillService::class)
                ->addBillToPayPeriod(
                    $payPeriod->id,
                    $bill->id,
                    $bill->amount,
                    $this->getPayPeriodBillDueDate($bill->due_date)
                );
        });
    }

    protected function autoGeneratePayPeriodBudgets(PayPeriod $payPeriod): void
    {
        $budgets = Budget::where('user_id', auth()->user()->id)->get();

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
