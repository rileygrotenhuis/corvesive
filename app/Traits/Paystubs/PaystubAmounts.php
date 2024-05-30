<?php

namespace App\Traits\Paystubs;

trait PaystubAmounts
{
    /**
     * Returns the total amount
     * deposited for this paystub.
     */
    public function getAmountDepositedAttribute(): int
    {
        return $this->deposits->sum('amount_in_cents');
    }

    /**
     * Returns the total amount yet
     * to be deposited for this paystub.
     */
    public function getAmountRemainingAttribute(): int
    {
        return $this->amount_in_cents - $this->amount_deposited;
    }
}
