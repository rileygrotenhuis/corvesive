<?php

namespace App\Repositories;

use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class PayPeriodAttributesRepository
{
    public function __construct(protected PayPeriod $payPeriod)
    {
    }

    public function getPayedBills(): Collection
    {
        return PayPeriodBill::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->where('pay_period_bill.has_payed', 1)
            ->get();
    }

    public function getUpcomingBills(): Collection
    {
        return PayPeriodBill::query()
            ->where('pay_period_id', $this->payPeriod->id)
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
        return PayPeriodBill::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->where('pay_period_bill.has_payed', 0)
            ->where(
                'pay_period_bill.due_date',
                '<',
                Carbon::today()->toDateString()
            )->get();
    }

    public function getRemainingBudgets(): Collection
    {
        return PayPeriodBudget::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->where('pay_period_budget.remaining_balance', '>', 0)
            ->get();
    }

    public function getOverpayedBudgets(): Collection
    {
        return PayPeriodBudget::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->where('pay_period_budget.remaining_balance', '<', 0)
            ->get();
    }

    public function getPayedBudgets(): Collection
    {
        return PayPeriodBudget::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->where('pay_period_budget.remaining_balance', 0)
            ->get();
    }

    public function getRecentTransactions(): Collection
    {
        return Transaction::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->whereBetween(
                'transactions.created_at',
                [
                    Carbon::today()->subDays(1)->toDateString(),
                    Carbon::today()->toDateString(),
                ]
            )->get();
    }
}
