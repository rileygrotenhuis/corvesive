<?php

namespace App\Services;

use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\PayPeriodPaystub;
use App\Models\PayPeriodSaving;
use Illuminate\Support\Collection;

class PayPeriodBreakdownService
{
    public function __construct(protected PayPeriod $payPeriod)
    {
    }

    public function getPaystubsBreakdown(): Collection
    {
        return PayPeriodPaystub::query()
            ->with('paystub')
            ->where('pay_period_id', $this->payPeriod->id)
            ->get();
    }

    public function getBillsBreakdown(): Collection
    {
        return PayPeriodBill::query()
            ->with('bill')
            ->where('pay_period_id', $this->payPeriod->id)
            ->get();
    }

    public function getBudgetsBreakdown(): Collection
    {
        return PayPeriodBudget::query()
            ->with('budget')
            ->where('pay_period_id', $this->payPeriod->id)
            ->get();
    }

    public function getSavingsBreakdown(): Collection
    {
        return PayPeriodSaving::query()
            ->with('monthlySaving')
            ->where('pay_period_id', $this->payPeriod->id)
            ->get();
    }
}
