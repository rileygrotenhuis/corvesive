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
        int $amountInCents,
        ?string $notes = null
    ): Deposit {
        return Deposit::query()->create([
            'user_id' => $user->id,
            'deposit_date' => now(),
            'amount_in_cents' => $amountInCents,
            'notes' => $notes,
        ]);
    }

    /**
     * Modify the amount and notes for an existing deposit.
     */
    public function modify(
        int $amountInCents,
        ?string $notes = null
    ): Deposit {
        $this->update([
            'amount_in_cents' => $amountInCents,
            'notes' => $notes,
        ]);

        return $this;
    }

    /**
     * Refund a deposit to remove it from the system.
     */
    public function refund(): void
    {
        $this->delete();
    }
}
