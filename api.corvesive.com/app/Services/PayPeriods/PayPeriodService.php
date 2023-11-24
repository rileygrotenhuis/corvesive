<?php

namespace App\Services\PayPeriods;

use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\PayPeriodPaystub;
use App\Models\User;

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
        $user = User::where('id', auth()->user()->id)->first();
        $user->pay_period_id = null;
        $user->save();

        PayPeriodPaystub::where('pay_period_id', $payPeriod->id)->delete();
        PayPeriodBudget::where('pay_period_id', $payPeriod->id)->delete();
        PayPeriodBill::where('pay_period_id', $payPeriod->id)->delete();

        return $payPeriod->delete();
    }
}
