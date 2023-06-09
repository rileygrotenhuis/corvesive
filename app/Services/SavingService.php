<?php

namespace App\Services;

use App\Models\PayPeriod;
use App\Models\Saving;
use App\Models\User;

class SavingService
{
    public function createSaving(
        User $user,
        PayPeriod $payPeriod,
        string $name,
        int $amount
    ): Saving {
        $saving = new Saving();

        $saving->user_id = $user->id;
        $saving->pay_period_id = $payPeriod->id;
        $saving->name = $name;
        $saving->amount = $amount;

        $saving->save();

        return $saving;
    }

    public function updateSaving(
        Saving $saving,
        string $name,
        int $amount
    ): Saving {
        $saving->name = $name;
        $saving->amount = $amount;

        $saving->save();

        return $saving;
    }

    public function deleteSaving(Saving $saving): bool
    {
        return $saving->delete();
    }

    public function updateSavingPayedStatus(Saving $saving, bool $hasPayed): Saving
    {
        $saving->has_payed = $hasPayed;
        $saving->save();

        $payPeriod = $saving->payPeriod;
        $payPeriod->remaining_balance = $payPeriod->remaining_balance - $saving->amount;
        $payPeriod->save();

        return $saving;
    }
}
