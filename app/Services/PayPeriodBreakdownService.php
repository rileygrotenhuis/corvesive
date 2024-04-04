<?php

namespace App\Services;

use App\Models\Deposit;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\PayPeriodPaystub;
use App\Models\PayPeriodSaving;
use App\Models\Transaction;
use Illuminate\Support\Collection;

class PayPeriodBreakdownService
{
    public function __construct(protected PayPeriod $payPeriod)
    {
    }

    public function getTotalIncome(): int
    {
        $totalPaystubs = PayPeriodPaystub::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->sum('amount_in_cents');

        return $totalPaystubs + $this->getTotalDeposits();
    }

    public function getTotalExpenses(): int
    {
        $billsTotal = PayPeriodBill::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->sum('amount_in_cents');

        $budgetsTotal = PayPeriodBudget::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->sum('total_balance_in_cents');

        $savingsTotal = PayPeriodSaving::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->sum('amount_in_cents');

        return $billsTotal + $budgetsTotal + $savingsTotal;
    }

    public function getTotalPayments(): int
    {
        return Transaction::query()
            ->where('user_id', $this->payPeriod->user_id)
            ->where('date', '>=', $this->payPeriod->start_date)
            ->where('date', '<=', $this->payPeriod->end_date)
            ->sum('amount_in_cents');
    }

    public function getTotalSurplusPayments(): int
    {
        return Transaction::query()
            ->where('date', '>=', $this->payPeriod->start_date)
            ->where('date', '<=', $this->payPeriod->end_date)
            ->whereNull('transactionable_type')
            ->whereNull('transactionable_id')
            ->sum('amount_in_cents');
    }

    public function getTotalDeposits(): int
    {
        return Deposit::query()
            ->where('user_id', $this->payPeriod->id)
            ->where('created_at', '>=', $this->payPeriod->start_date)
            ->where('created_at', '<=', $this->payPeriod->end_date)
            ->sum('amount_in_cents');
    }

    public function getDueBills(): Collection
    {
        return PayPeriodBill::query()
            ->with('bill')
            ->where('pay_period_id', $this->payPeriod->id)
            ->get()
            ->where('has_paid', false)
            ->values();
    }

    public function getRemainingBudgets(): Collection
    {
        return PayPeriodBudget::query()
            ->with('budget')
            ->where('pay_period_id', $this->payPeriod->id)
            ->get()
            ->where('remaining_balance', '>', 0)
            ->values();
    }

    public function getRemainingSavings(): Collection
    {
        return PayPeriodSaving::query()
            ->with('monthlySaving')
            ->where('pay_period_id', $this->payPeriod->id)
            ->get()
            ->where('has_paid', false)
            ->values();
    }

    public function getActualSurplus(): int
    {
        return $this->getTotalIncome() - $this->getTotalPayments();
    }

    public function getProjectedSurplus(): int
    {
        return $this->getTotalIncome() - $this->getTotalSurplusPayments() - $this->getTotalExpenses();
    }
}
