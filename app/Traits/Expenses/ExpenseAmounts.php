<?php

namespace App\Traits\Expenses;

trait ExpenseAmounts
{
    /**
     * Returns the total amount that
     * has been paid for this expense.
     */
    public function getAmountPaidAttribute(): int
    {
        return $this->payments->sum('amount_in_cents');
    }

    /**
     * Returns the total amount yet
     * to be paid for this expense.
     */
    public function getAmountRemainingAttribute(): int
    {
        return $this->amount_in_cents - $this->amount_paid;
    }
}
