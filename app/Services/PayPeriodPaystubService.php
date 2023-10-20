<?php

namespace App\Services;

use App\Models\PayPeriod;
use App\Models\PayPeriodPaystub;
use App\Models\Paystub;

class PayPeriodPaystubService
{
    public function addPaystubToPayPeriod(
        PayPeriod $payPeriod,
        Paystub $paystub
    ): void {
        $payPeriodPaystub = new PayPeriodPaystub();
        $payPeriodPaystub->pay_period_id = $payPeriod->id;
        $payPeriodPaystub->paystub_id = $paystub->id;
        $payPeriodPaystub->save();

        $payPeriod->total_income = $payPeriod->total_income + $paystub->amount;
        $payPeriod->save();
    }

    public function removePaystubFromPayPeriod(
        PayPeriod $payPeriod,
        Paystub $paystub
    ): void {
        PayPeriodPaystub::where('pay_period_id', $payPeriod->id)
            ->where('paystub_id', $paystub->id)
            ->delete();

        $payPeriod->total_income = $payPeriod->total_income - $paystub->amount;
        $payPeriod->save();
    }
}
