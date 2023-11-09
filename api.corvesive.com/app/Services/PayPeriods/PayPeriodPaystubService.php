<?php

namespace App\Services\PayPeriods;

use App\Models\PayPeriod;
use App\Models\PayPeriodPaystub;
use App\Models\Paystub;

class PayPeriodPaystubService
{
    public function addPaystubToPayPeriod(
        PayPeriod $payPeriod,
        Paystub $paystub,
        int $amount
    ): void {
        $payPeriodPaystub = new PayPeriodPaystub();
        $payPeriodPaystub->pay_period_id = $payPeriod->id;
        $payPeriodPaystub->paystub_id = $paystub->id;
        $payPeriodPaystub->amount = $amount;
        $payPeriodPaystub->save();
    }

    public function updatePayPeriodPaystub(
        PayPeriod $payPeriod,
        Paystub $paystub,
        int $amount
    ): void {
        PayPeriodPaystub::where('pay_period_id', $payPeriod->id)
            ->where('paystub_id', $paystub->id)
            ->update([
                'amount' => $amount,
            ]);
    }

    public function removePaystubFromPayPeriod(
        PayPeriod $payPeriod,
        Paystub $paystub
    ): void {
        PayPeriodPaystub::where('pay_period_id', $payPeriod->id)
            ->where('paystub_id', $paystub->id)
            ->delete();
    }

    public function autoGeneratePayPeriodPaystubs(PayPeriod $payPeriod): void
    {
        $paystubs = Paystub::where('user_id', auth()->user()->id)->get();

        $paystubs->each(function ($paystub) use ($payPeriod) {
            $this->addPaystubToPayPeriod(
                $payPeriod,
                $paystub,
                $paystub->amount / $payPeriod->numberOfDays()
            );
        });
    }

    public function paystubIsAlreadyAttachedToPayPeriod(PayPeriod $payPeriod, Paystub $paystub): bool
    {
        return PayPeriodPaystub::withoutTrashed()
            ->where('pay_period_id', $payPeriod->id)
            ->where('paystub_id', $paystub->id)
            ->exists();
    }
}
