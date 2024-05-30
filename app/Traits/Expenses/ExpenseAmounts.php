<?php

namespace App\Traits\Expenses;

trait ExpenseAmounts
{
    public function getAmountPaidAttribute(): int
    {
        return $this->payments->sum('amount_in_cents');
    }

    public function getAmountRemainingAttribute(): int
    {
        return $this->amount_in_cents - $this->amount_paid;
    }
}
