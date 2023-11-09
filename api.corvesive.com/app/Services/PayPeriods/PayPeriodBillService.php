<?php

namespace App\Services\PayPeriods;

use App\Models\Bill;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use Carbon\Carbon;

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

        logger($payPeriodBill);
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

    public function autoGeneratePayPeriodBills(PayPeriod $payPeriod): void
    {
        $bills = Bill::where('user_id', auth()->user()->id)
            ->where('due_date', '>=', Carbon::parse($payPeriod->start_date)->day)
            ->where('due_date', '<=', Carbon::parse($payPeriod->end_date)->day)
            ->get();

        $bills->each(function ($bill) use ($payPeriod) {
            $this->addBillToPayPeriod(
                $payPeriod->id,
                $bill->id,
                $bill->amount,
                $this->getPayPeriodBillDueDate($bill->due_date)
            );
        });
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

    protected function getPayPeriodBillDueDate(string $dueDate): Carbon
    {
        return Carbon::create(
            Carbon::now()->year,
            Carbon::now()->month,
            $dueDate
        );
    }
}
