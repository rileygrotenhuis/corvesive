<?php

namespace App\Traits\Transactions;

use App\Models\Deposit;
use App\Models\User;

trait DepositManager
{
    /**
     * Makes a deposit for a user.
     */
    public static function makeDeposit(
        User $user,
        string $depositDate,
        int $amountInCents,
        ?string $notes = null
    ): Deposit {
        return Deposit::query()->create([
            'user_id' => $user->id,
            'monthly_paystub_id' => null,
            'deposit_date' => $depositDate,
            'amount_in_cents' => $amountInCents,
            'notes' => $notes,
        ]);
    }

    /**
     * Refund a deposit to remove it from the system.
     */
    public function refund(): void
    {
        $this->delete();
    }
}
