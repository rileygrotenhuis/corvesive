<?php

namespace App\Objects;

use App\Models\PayPeriod;
use Illuminate\Support\Collection;

class PayPeriodMetrics
{
    protected Collection $billMetrics;

    protected Collection $budgetMetrics;

    protected Collection $incomeMetrics;

    protected Collection $transactionMetrics;

    protected Collection $surplusMetrics;

    public function __construct(protected PayPeriod $payPeriod)
    {
        $this->billMetrics = $this->collectBillMetrics();
        $this->budgetMetrics = $this->collectBudgetMetrics();
        $this->incomeMetrics = $this->collectIncomeMetrics();
        $this->transactionMetrics = $this->collectTransactionMetrics();
        $this->surplusMetrics = $this->collectSurplusMetrics();
    }

    public function get(): Collection
    {
        return collect([
            'bills' => $this->billMetrics,
            'budgets' => $this->budgetMetrics,
            'income' => $this->incomeMetrics,
            'transactions' => $this->transactionMetrics,
            'surplus' => $this->surplusMetrics,
        ]);
    }

    protected function collectBillMetrics(): Collection
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

    protected function collectBudgetMetrics(): Collection
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

    protected function collectIncomeMetrics(): Collection
    {
        return collect([
            'total_income' => $this->payPeriod->total_balance,
            'paystubs_total' => $this->payPeriod->paystubs->sum('amount'),
        ]);
    }

    protected function collectTransactionMetrics(): Collection
    {
        $budgetSpent = $this->payPeriod->transactions()
            ->whereNotNull('pay_period_budget_id')
            ->whereNull('pay_period_bill_id')
            ->where('type', '=', 'payment')
            ->sum('amount');

        $billSpent = $this->payPeriod->transactions()
            ->whereNull('pay_period_budget_id')
            ->whereNotNull('pay_period_bill_id')
            ->where('type', '=', 'payment')
            ->sum('amount');

        return collect([
            'spent' => [
                'budgets' => $budgetSpent,
                'bills' => $billSpent,
                'total' => $budgetSpent + $billSpent,
            ],
            'deposit' => $this->payPeriod->transactions()
                ->whereNull('pay_period_budget_id')
                ->whereNull('pay_period_bill_id')
                ->where('type', '=', 'deposit')
                ->sum('amount'),
        ]);
    }

    protected function collectSurplusMetrics(): Collection
    {
        return collect([
            'current' => $this->incomeMetrics['total_income'] - $this->transactionMetrics['spent']['total'],
            'projected' => $this->incomeMetrics['total_income'] - $this->billMetrics['total'] - $this->budgetMetrics['total_balance'],
        ]);
    }
}
