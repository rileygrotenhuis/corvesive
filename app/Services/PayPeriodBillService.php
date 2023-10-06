<?php

namespace App\Services;

use App\Models\PayPeriodBill;

class PayPeriodBillService
{
    public function addBillToPayPeriod(
        int $payPeriodId,
        int $billId,
        int $amount,
        string $dueDate,
    ): void {
        $payPeriodBill = new PayPeriodBill();
        $payPeriodBill->pay_period_id = $payPeriodId;
        $payPeriodBill->bill_id = $billId;
        $payPeriodBill->amount = $amount;
        $payPeriodBill->due_date = $dueDate;
        $payPeriodBill->save();
    }

    public function updatePayPeriodBill(
        int $payPeriodId,
        int $billId,
        int $amount,
        string $dueDate,
    ): void {
        PayPeriodBill::where('pay_period_id', $payPeriodId)
            ->where('bill_id', $billId)
            ->update([
                'amount' => $amount,
                'due_date' => $dueDate,
            ]);
    }

    public function removeBillFromPayPeriod(
        int $payPeriodId,
        int $billId
    ): void {
        PayPeriodBill::where('pay_period_id', $payPeriodId)
            ->where('bill_id', $billId)
            ->delete();
    }
}
