<?php

namespace App\Services\PayPeriods;

use App\Models\Bill;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Services\TransactionService;
use Carbon\Carbon;

class PayPeriodBillService
{
    public function addBillToPayPeriod(
        int $payPeriodId,
        int $billId,
        int $amount,
        string $dueDate,
        bool $isAutomatic,
    ): void {
        $payPeriodBill = new PayPeriodBill();
        $payPeriodBill->pay_period_id = $payPeriodId;
        $payPeriodBill->bill_id = $billId;
        $payPeriodBill->amount = $amount;
        $payPeriodBill->due_date = $dueDate;
        $payPeriodBill->is_automatic = $isAutomatic;
        $payPeriodBill->save();
    }

    public function updatePayPeriodBill(
        int $payPeriodId,
        int $billId,
        int $amount,
        string $dueDate,
        bool $isAutomatic,
    ): void {
        PayPeriodBill::where('pay_period_id', $payPeriodId)
            ->where('bill_id', $billId)
            ->update([
                'amount' => $amount,
                'due_date' => $dueDate,
                'is_automatic' => $isAutomatic,
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

    public function getPayPeriodBillStatus(bool $hasPayed, string $dueDate): string
    {
        if ($hasPayed) {
            return 'payed';
        }

        $today = Carbon::today();

        if ($today->toDateString() >= $dueDate) {
            return 'late';
        }

        if ($today->addDay()->toDateString() === $dueDate) {
            return 'upcoming';
        }

        return 'unpayed';
    }

    public function billIsAlreadyAttachedToPayPeriod(PayPeriod $payPeriod, Bill $bill): bool
    {
        return PayPeriodBill::withoutTrashed()
            ->where('pay_period_id', $payPeriod->id)
            ->where('bill_id', $bill->id)
            ->exists();
    }

    public function updateAutoPaymentBills(): void
    {
        $bills = PayPeriodBill::where('due_date', Carbon::today()->toDateString())->where('is_automatic', 1)->get();

        foreach ($bills as $bill) {
            resolve(TransactionService::class)->createBillTransaction(
                $bill->payPeriod,
                $bill,
            );
        }
    }
}
