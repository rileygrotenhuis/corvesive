<?php

namespace App\Traits\Expenses;

use App\Models\Payment;

trait ExpensePayments
{
    /**
     * Make a payment for a monthly expense.
     */
    public function payment(
        string $paymentDate,
        int $amountInCents,
        ?string $notes = null
    ): Payment {
        return Payment::query()->create([
            'user_id' => $this->user_id,
            'monthly_expense_id' => $this->id,
            'payment_date' => $paymentDate,
            'amount_in_cents' => $amountInCents,
            'notes' => $notes,
        ]);
    }

    /**
     * Pay off a monthly expense in full.
     */
    public function payInFull(
        string $paymentDate,
        ?string $notes = null
    ): Payment {
        return Payment::query()->create([
            'user_id' => $this->user_id,
            'monthly_expense_id' => $this->id,
            'payment_date' => $paymentDate,
            'amount_in_cents' => $this->amount_in_cents,
            'notes' => $notes,
        ]);
    }
}
