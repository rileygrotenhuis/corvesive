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
        string $name,
        int $amount
    ): Bill {
        $bill->name = $name;
        $bill->amount = $amount;

        $bill->save();

        return $bill;
    }

    public function deleteBill(Bill $bill): bool
    {
        return $bill->delete();
    }

    public function updateBillPayedStatus(Bill $bill, bool $hasPayed): Bill
    {
        $bill->has_payed = $hasPayed;
        $bill->save();

        $payPeriod = $bill->payPeriod;
        $payPeriod->remaining_balance = $payPeriod->remaining_balance - $bill->amount;
        $payPeriod->save();

        return $bill;
    }
}
