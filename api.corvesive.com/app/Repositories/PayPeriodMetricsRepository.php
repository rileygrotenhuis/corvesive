<?php

namespace App\Repositories;

use App\Models\PayPeriod;

class PayPeriodMetricsRepository
{
    public function __construct(protected PayPeriod $payPeriod)
    {
    }

    public function getPaystubsTotal(): int
    {
        return $this->payPeriod->paystubs()
            ->whereNull('pay_period_paystub.deleted_at')
            ->sum('pay_period_paystub.amount');
    }

    public function getDepositsTotal(): int
    {
        return $this->payPeriod->transactions()
            ->whereNull('deleted_at')
            ->where('transactions.type', 'deposit')
            ->sum('transactions.amount');
    }

    public function getPaymentsTotal(): int
    {
        return $this->payPeriod->transactions()
            ->whereNull('deleted_at')
            ->whereNull('transactions.pay_period_bill_id')
            ->whereNull('transactions.pay_period_budget_id')
            ->where('transactions.type', 'payment')
            ->sum('transactions.amount');
    }

    public function getPayedBillsTotal(): int
    {
        return $this->payPeriod->bills()
            ->whereNull('pay_period_bill.deleted_at')
            ->where('pay_period_bill.has_payed', 1)
            ->sum('pay_period_bill.amount');
    }

    public function getUnpayedBillsTotal(): int
    {
        return $this->payPeriod->bills()
            ->whereNull('pay_period_bill.deleted_at')
            ->where('pay_period_bill.has_payed', 0)
            ->sum('pay_period_bill.amount');
    }

    public function getBudgetsBalanceTotal(): int
    {
        return $this->payPeriod->budgets()
            ->whereNull('pay_period_budget.deleted_at')
            ->sum('pay_period_budget.total_balance');
    }

    public function getRemainingBudgetsTotal(): int
    {
        return $this->payPeriod->budgets()
            ->whereNull('pay_period_budget.deleted_at')
            ->sum('pay_period_budget.remaining_balance');
    }

    public function getSavingsTotal(): int
    {
        return $this->payPeriod->savingAccounts()
            ->whereNull('pay_period_saving.deleted_at')
            ->sum('pay_period_saving.amount');
    }
}
