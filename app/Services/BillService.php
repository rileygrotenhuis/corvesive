<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\PayPeriod;
use App\Models\User;

class BillService
{
    public function createBill(
        User $user,
        PayPeriod $payPeriod,
        string $name,
        int $amount
    ): Bill {
        $bill = new Bill();

        $bill->user_id = $user->id;
        $bill->pay_period_id = $payPeriod->id;
        $bill->name = $name;
        $bill->amount = $amount;

        $bill->save();

        return $bill;
    }

    public function updateBill(
        Bill $bill,
        PayPeriod $payPeriod,
        string $name,
        int $amount
    ): Bill {
        $bill->pay_period_id = $payPeriod->id;
        $bill->name = $name;
        $bill->amount = $amount;

        $bill->save();

        return $bill;
    }
}
