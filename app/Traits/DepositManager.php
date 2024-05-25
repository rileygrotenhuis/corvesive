<?php

namespace App\Traits;

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
        Deposit $deposit,
        int $amountInCents,
        ?string $notes = null
    ): Deposit {
        $deposit->update([
            'amount_in_cents' => $amountInCents,
            'notes' => $notes,
        ]);

        return $deposit;
    }

    /**
     * Refund a deposit to remove it from the system.
     */
    public function refund(Deposit $deposit): void
    {
        $deposit->delete();
    }
}
