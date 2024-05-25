<?php

namespace App\Traits;

use App\Models\Deposit;
use App\Models\User;

trait DepositManager
{
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

    public function refund(Deposit $deposit): void
    {
        $deposit->delete();
    }
}
