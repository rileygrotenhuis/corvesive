<?php

namespace App\Services;

use App\Models\PayPeriodPaystub;

class PayPeriodPaystubService
{
    public function addPaystubToPayPeriod(
        int $payPeriodId,
        int $paystubId
    ): void {
        $payPeriodPaystub = new PayPeriodPaystub();
        $payPeriodPaystub->pay_period_id = $payPeriodId;
        $payPeriodPaystub->paystub_id = $paystubId;
        $payPeriodPaystub->save();
    }

    public function removePaystubFromPayPeriod(
        int $payPeriodId,
        int $paystubId
    ): void {
        PayPeriodPaystub::where('pay_period_id', $payPeriodId)
            ->where('paystub_id', $paystubId)
            ->delete();
    }
}
