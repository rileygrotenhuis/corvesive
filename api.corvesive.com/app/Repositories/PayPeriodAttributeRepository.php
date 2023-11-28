<?php

namespace App\Repositories;

use App\Models\PayPeriod;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class PayPeriodAttributeRepository
{
    public function __construct(protected PayPeriod $payPeriod)
    {
    }

    public function getPayedBills(): Collection
    {
        return $this->payPeriod->bills()
            ->whereNull('pay_period_bill.deleted_at')
            ->where('pay_period_bill.has_payed', 1)
            ->get();
    }

    public function getUpcomingBills(): Collection
    {
        return $this->payPeriod->bills()
            ->whereNull('pay_period_bill.deleted_at')
            ->where('pay_period_bill.has_payed', 0)
            ->whereBetween(
                'pay_period_bill.due_date',
                [
                    Carbon::today()->toDateString(),
                    Carbon::today()->addDays(3)->toDateString(),
                ]
            )->get();
    }

    public function getOverdueBills(): Collection
    {
        return $this->payPeriod->bills()
            ->whereNull('pay_period_bill.deleted_at')
            ->where('pay_period_bill.has_payed', 0)
            ->where(
                'pay_period_bill.due_date',
                '<',
                Carbon::today()->toDateString()
            )->get();
    }

    public function getRemainingBudgets(): Collection
    {
        return $this->payPeriod->budgets()
            ->whereNull('pay_period_budget.deleted_at')
            ->where('pay_period_budget.remaining_balance', '>', 0)
            ->get();
    }

    public function getOverpayedBudgets(): Collection
    {
        return $this->payPeriod->budgets()
            ->whereNull('pay_period_budget.deleted_at')
            ->where('pay_period_budget.remaining_balance', '<', 0)
            ->get();
    }

    public function getPayedBudgets(): Collection
    {
        return $this->payPeriod->budgets()
            ->whereNull('pay_period_budget.deleted_at')
            ->where('pay_period_budget.remaining_balance', 0)
            ->get();
    }

    public function getRecentTransactions(): Collection
    {
        return $this->payPeriod->transactions()
            ->whereNull('transactions.deleted_at')
            ->whereBetween(
                'transactions.created_at',
                [
                    Carbon::today()->subDays(1)->toDateString(),
                    Carbon::today()->toDateString(),
                ]
            )->get();
    }
}
