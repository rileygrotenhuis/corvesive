<?php

namespace App\Traits\Paystubs;

use App\Models\Deposit;

trait PaystubDeposits
{
    /**
     * Make a deposit for a paystub.
     */
    public function deposit(string $depositDate, ?string $notes = null): Deposit {
        return Deposit::query()->create([
            'user_id' => $this->user_id,
            'monthly_paystub_id' => $this->id,
            'deposit_date' => $depositDate,
            'amount_in_cents' => $this->amount_in_cents,
            'notes' => $notes,
        ]);
    }
}
