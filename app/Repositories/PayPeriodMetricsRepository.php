<?php

namespace App\Repositories;

use App\Models\PayPeriod;
use Illuminate\Support\Collection;

class PayPeriodMetricsRepository
{
    public function __construct(protected PayPeriod $payPeriod)
    {
    }

    public function getBillMetrics(): Collection
    {
        $totalPayed = $this->payPeriod->bills()
            ->where('pay_period_bill.has_payed', 1)
            ->sum('pay_period_bill.amount');

        $totalUnpayed = $this->payPeriod->bills()
            ->where('pay_period_bill.has_payed', 0)
            ->sum('pay_period_bill.amount');

        return collect([
            'payed' => $totalPayed,
            'unpayed' => $totalUnpayed,
            'total' => $totalPayed + $totalUnpayed,
        ]);
    }

    public function getBudgetMetrics(): Collection
    {
        return collect([
            'total_balance' => $this->payPeriod
                ->budgets()
                ->sum('pay_period_budget.total_balance'),
            'remaining_balance' => $this->payPeriod
                ->budgets()
                ->sum('pay_period_budget.remaining_balance'),
        ]);
    }

    public function getIncomeMetrics(): Collection
    {
        return collect([
            'paystubs_total' => $this->payPeriod->paystubs->sum('amount'),
        ]);
    }

    public function getTransactionMetrics(): Collection
    {
        $billSpent = $this->payPeriod->transactions()
            ->whereNull('pay_period_budget_id')
            ->whereNotNull('pay_period_bill_id')
            ->where('type', '=', 'payment')
            ->sum('amount');

        $budgetSpent = $this->payPeriod->transactions()
            ->whereNotNull('pay_period_budget_id')
            ->whereNull('pay_period_bill_id')
            ->where('type', '=', 'payment')
            ->sum('amount');

        return collect([
            'spent' => [
                'bills' => $billSpent,
                'budgets' => $budgetSpent,
                'total' => $budgetSpent + $billSpent,
            ],
            'deposit' => $this->payPeriod->transactions()
                ->whereNull('pay_period_budget_id')
                ->whereNull('pay_period_bill_id')
                ->where('type', '=', 'deposit')
                ->sum('amount'),
        ]);
    }
}
