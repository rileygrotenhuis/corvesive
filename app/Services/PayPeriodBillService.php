<?php

namespace App\Services;

use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\User;
use Illuminate\Support\Collection;

class PayPeriodBillService
{
    public function __construct(
        protected User $user,
        protected PayPeriod $payPeriod
    ) {
    }

    public function getUnassignedBills(): Collection
    {
        return $this->user->monthlyBills()
            ->whereNotIn('id', $this->getCurrentPayPeriodBills())
            ->get()
            ->map(function ($bill) {
                return [
                    'id' => $bill->id,
                    'issuer' => $bill->issuer,
                    'name' => $bill->name,
                    'amount_in_cents' => $bill->amount_in_cents,
                    'due_day_of_month' => $bill->due_day_of_month,
                    'notes' => $bill->notes,
                    // TODO: 'has_paid' => $bill->has_paid
                ];
            });
    }

    protected function getCurrentPayPeriodBills(): Collection
    {
        return PayPeriodBill::query()
            ->where('pay_period_id', $this->payPeriod->id)
            ->pluck('id');
    }
}
