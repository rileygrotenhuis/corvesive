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

    public function getBreakdownData(): array
    {
        return [
            'paystubs' => $this->getPaystubsBreakdown(),
            'bills' => $this->getBillsBreakdown(),
            'budgets' => $this->getBudgetsBreakdown(),
            'savings' => $this->getSavingsBreakdown(),
        ];
    }

    protected function getPaystubsBreakdown(): Collection
    {
        return PayPeriodPaystub::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->get();
    }

    protected function getBillsBreakdown(): Collection
    {
        return PayPeriodBill::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->get()
            ->where('has_paid', false);
    }

    protected function getBudgetsBreakdown(): Collection
    {
        return PayPeriodBudget::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->get()
            ->where('remaining_balance', '>', 0);
    }

    protected function getSavingsBreakdown(): Collection
    {
        return PayPeriodSaving::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->get()
            ->where('remaining_amount', '>', 0);
    }
}
