<?php

namespace App\Services;

use App\Models\PayPeriod;

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
        string $endDate,
        int $totalBalance
    ): PayPeriod {
        $payPeriod->start_date = $startDate;
        $payPeriod->end_date = $endDate;
        $payPeriod->total_balance = $totalBalance;
        $payPeriod->save();

        return $payPeriod;
    }

    public function deletePayPeriod(PayPeriod $payPeriod): bool
    {
        return $payPeriod->delete();
    }
}
