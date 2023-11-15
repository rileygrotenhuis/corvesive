<?php

namespace App\Services\PayPeriods;

use App\Models\PayPeriod;
use App\Models\PayPeriodSaving;
use App\Models\Saving;

class PayPeriodSavingService
{
    public function addSavingToPayPeriod(
        PayPeriod $payPeriod,
        Saving $saving,
        int $amount
    ): void {
        $payPeriodSaving = new PayPeriodSaving();
        $payPeriodSaving->pay_period_id = $payPeriod->id;
        $payPeriodSaving->saving_id = $saving->id;
        $payPeriodSaving->amount = $amount;
        $payPeriodSaving->save();
    }

    public function updatePayPeriodSaving(
        int $payPeriodId,
        int $savingId,
        int $amount
    ): void {
        PayPeriodSaving::where('pay_period_id', $payPeriodId)
            ->where('saving_id', $savingId)
            ->update([
                'amount' => $amount,
            ]);
    }

    public function removeSavingFromPayPeriod(
        PayPeriod $payPeriod,
        Saving $saving,
    ): void {
        PayPeriodSaving::where('pay_period_id', $payPeriod->id)
            ->where('saving_id', $saving->id)
            ->delete();
    }

    public function savingIsAlreadyAttachedToPayPeriod(PayPeriod $payPeriod, Saving $saving): bool
    {
        return PayPeriodSaving::withoutTrashed()
            ->where('pay_period_id', $payPeriod->id)
            ->where('saving_id', $saving->id)
            ->exists();
    }
}
