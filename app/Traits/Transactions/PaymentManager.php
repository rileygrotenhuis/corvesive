<?php

namespace App\Traits\Transactions;

use App\Models\Payment;
use App\Models\User;

trait PaymentManager
{
    /**
     * Makes a surplus payment for a user.
     */
    public static function payment(
        User $user,
        string $paymentDate,
        int $amountInCents,
        ?string $notes = null
    ): Payment {
        return Payment::query()->create([
            'user_id' => $user->id,
            'monthly_expense_id' => null,
            'payment_date' => $paymentDate,
            'amount_in_cents' => $amountInCents,
            'notes' => $notes,
        ]);
    }

    /**
     * Refunds a payment a user has made.
     */
    public function refund(): void
    {
        $this->delete();
    }
}
