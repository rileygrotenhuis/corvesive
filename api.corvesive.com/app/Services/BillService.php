<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\PayPeriodBill;

class BillService
{
    public function createBill(
        int $userId,
        string $issuer,
        string $name,
        int $amount,
        int $dueDate,
        bool $isAutomatic,
        ?string $notes
    ): Bill {
        $bill = new Bill();
        $bill->user_id = $userId;
        $bill->issuer = $issuer;
        $bill->name = $name;
        $bill->amount = $amount;
        $bill->due_date = $dueDate;
        $bill->is_automatic = $isAutomatic;
        $bill->notes = $notes;
        $bill->save();

        return $bill;
    }

    public function updateBill(
        Bill $bill,
        string $issuer,
        string $name,
        int $amount,
        int $dueDate,
        bool $isAutomatic,
        ?string $notes
    ): Bill {
        $bill->issuer = $issuer;
        $bill->name = $name;
        $bill->amount = $amount;
        $bill->due_date = $dueDate;
        $bill->is_automatic = $isAutomatic;
        $bill->notes = $notes;
        $bill->save();

        return $bill;
    }

    public function deleteBill(Bill $bill): bool
    {
        $this->removeAttachedPayPeriodBills($bill);

        return $bill->delete();
    }

    protected function removeAttachedPayPeriodBills(Bill $bill): void
    {
        PayPeriodBill::where('bill_id', $bill->id)->delete();
    }
}
