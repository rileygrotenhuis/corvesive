<?php

namespace App\Traits\Paystubs;

trait PaystubAmounts
{
    public function getAmountDepositedAttribute(): int
    {
        return $this->deposits->sum('amount_in_cents');
    }

    public function getAmountRemainingAttribute(): int
    {
        return $this->amount_in_cents - $this->amount_deposited;
    }
}
