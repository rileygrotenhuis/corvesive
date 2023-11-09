<?php

namespace App\Services\PayPeriods;

use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\PayPeriodBudget;

class PayPeriodBudgetService
{
    public function addBudgetToPayPeriod(
        PayPeriod $payPeriod,
        Budget $budget,
        int $totalBalance
    ): void {
        $payPeriodBudget = new PayPeriodBudget();
        $payPeriodBudget->pay_period_id = $payPeriod->id;
        $payPeriodBudget->budget_id = $budget->id;
        $payPeriodBudget->total_balance = $totalBalance;
        $payPeriodBudget->remaining_balance = $totalBalance;
        $payPeriodBudget->save();
    }

    public function updatePayPeriodBudget(
        int $payPeriodId,
        int $budgetId,
        int $totalBalance,
        int $remainingBalance,
    ): void {
        PayPeriodBudget::where('pay_period_id', $payPeriodId)
            ->where('budget_id', $budgetId)
            ->update([
                'total_balance' => $totalBalance,
                'remaining_balance' => $remainingBalance,
            ]);
    }

    public function removeBudgetFromPayPeriod(
        PayPeriod $payPeriod,
        Budget $budget,
    ): void {
        PayPeriodBudget::where('pay_period_id', $payPeriod->id)
            ->where('budget_id', $budget->id)
            ->delete();
    }

    public function autoGeneratePayPeriodBudgets(PayPeriod $payPeriod): void
    {
        $budgets = Budget::where('user_id', auth()->user()->id)->get();

        $budgets->each(function ($budget) use ($payPeriod) {
            $this->addBudgetToPayPeriod(
                $payPeriod,
                $budget,
                $budget->amount * $payPeriod->monthCoveragePercentage()
            );
        });
    }

    public function budgetIsAlreadyAttachedToPayPeriod(PayPeriod $payPeriod, Budget $budget): bool
    {
        return PayPeriodBudget::withoutTrashed()
            ->where('pay_period_id', $payPeriod->id)
            ->where('budget_id', $budget->id)
            ->exists();
    }
}
