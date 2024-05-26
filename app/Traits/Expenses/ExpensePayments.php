<?php

namespace App\Traits\Expenses;

use App\Models\MonthlyExpense;
use App\Models\Payment;

trait ExpensePayments
{
    /**
     * Make a payment for a monthly expense.
     */
    public function payment(
        MonthlyExpense $monthlyExpense,
        string $paymentDate,
        int $amountInCents,
        ?string $notes = null
    ): Payment {
        return Payment::query()->create([
            'user_id' => $monthlyExpense->user_id,
            'monthly_expense_id' => $monthlyExpense->id,
            'payment_date' => $paymentDate,
            'amount_in_cents' => $amountInCents,
            'notes' => $notes,
        ]);
    }

    /**
     * Pay off a monthly expense in full.
     */
    public function payInFull(
        MonthlyExpense $monthlyExpense,
        string $paymentDate,
        ?string $notes = null
    ): Payment {
        return Payment::query()->create([
            'user_id' => $monthlyExpense->user_id,
            'monthly_expense_id' => $monthlyExpense->id,
            'payment_date' => $paymentDate,
            'amount_in_cents' => $monthlyExpense->amount_in_cents,
            'notes' => $notes,
        ]);
    }
}
