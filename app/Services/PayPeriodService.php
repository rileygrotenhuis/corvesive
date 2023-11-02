<?php

namespace App\Services;

use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\PayPeriodPaystub;

class PayPeriodService
{
    public function createPayPeriod(
        int $userId,
        string $startDate,
        string $endDate
    ): PayPeriod {
        $payPeriod = new PayPeriod();
        $payPeriod->user_id = $userId;
        $payPeriod->start_date = $startDate;
        $payPeriod->end_date = $endDate;
        $payPeriod->save();

        return $payPeriod;
    }

    public function updatePayPeriod(
        PayPeriod $payPeriod,
        string $startDate,
        string $endDate
    ): PayPeriod {
        $payPeriod->start_date = $startDate;
        $payPeriod->end_date = $endDate;
        $payPeriod->save();

        return $payPeriod;
    }

    public function deletePayPeriod(PayPeriod $payPeriod): bool
    {
        PayPeriodPaystub::where('pay_period_id', $payPeriod->id)->delete();
        PayPeriodBudget::where('pay_period_id', $payPeriod->id)->delete();
        PayPeriodBill::where('pay_period_id', $payPeriod->id)->delete();

        return $payPeriod->delete();
    }
}
