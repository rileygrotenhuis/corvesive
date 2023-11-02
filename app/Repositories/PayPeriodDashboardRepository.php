<?php

namespace App\Repositories;

use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use Illuminate\Support\Collection;

class PayPeriodDashboardRepository
{
    public function __construct(protected PayPeriod $payPeriod)
    {
    }

    public function getUpcomingBills(): Collection
    {
        return PayPeriodBill::with('bill')
            ->where('pay_period_id', $this->payPeriod->id)
            ->where('has_payed', 0)
            ->get();
    }

    public function getRemainingBudgets(): Collection
    {
        return PayPeriodBudget::with('budget')
            ->where('pay_period_id', $this->payPeriod->id)
            ->where('remaining_balance', '>', 0)
            ->get();
    }
}
