<?php

namespace App\Services;

use App\Models\PayPeriod;
use App\Models\User;

class PayPeriodService
{
    public function createPayPeriod(
        User $user,
        string $startDate,
        string $endDate,
        int $totalBalance
    ): PayPeriod {
        $payPeriod = new PayPeriod();

        $payPeriod->user_id = $user->id;
        $payPeriod->start_date = $startDate;
        $payPeriod->end_date = $endDate;
        $payPeriod->total_balance = $totalBalance;

        $payPeriod->save();

        return $payPeriod;
    }

    public function updatePayPeriod(
        PayPeriod $payPeriod,
        string $startDate,
        string $endDate,
        int $totalBalance
    ): PayPeriod {
        $payPeriod->start_date = $startDate;
        $payPeriod->end_date = $endDate;
        $payPeriod->total_balance = $totalBalance;

        $payPeriod->save();

        return $payPeriod;
    }
}
