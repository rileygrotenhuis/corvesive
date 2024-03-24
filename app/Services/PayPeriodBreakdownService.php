<?php

namespace App\Services;

use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\PayPeriodSaving;
use Illuminate\Support\Collection;

class PayPeriodBreakdownService
{
    public function __construct(protected PayPeriod $payPeriod)
    {
    }

    protected function getDueBills(): Collection
    {
        return PayPeriodBill::query()
            ->with('bill')
            ->where('pay_period_id', $this->payPeriod->id)
            ->get()
            ->where('has_paid', false);
    }

    protected function getRemainingBudgets(): Collection
    {
        return PayPeriodBudget::query()
            ->with('budget')
            ->where('pay_period_id', $this->payPeriod->id)
            ->get()
            ->where('remaining_balance', '>', 0);
    }

    protected function getRemainingSavings(): Collection
    {
        return PayPeriodSaving::query()
            ->with('saving')
            ->where('pay_period_id', $this->payPeriod->id)
            ->get()
            ->where('has_paid', false);
    }

    // TODO: Actual Surplus

    // TODO: Projected Surplus
}
