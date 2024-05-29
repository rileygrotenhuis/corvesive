<?php

namespace App\Traits\Paystubs;

use App\Models\Paystub;
use App\Models\User;

trait PaystubManager
{
    /**
     * Adds a new Paystub for a user.
     */
    public static function add(
        User $user,
        string $issuer,
        int $amountInCents,
        string $recurrenceRate,
        string $recurrenceIntervalOne,
        ?string $recurrenceIntervalTwo,
        ?string $notes,
    ): Paystub {
        return Paystub::query()->create([
            'user_id' => $user->id,
            'issuer' => $issuer,
            'amount_in_cents' => $amountInCents,
            'recurrence_rate' => $recurrenceRate,
            'recurrence_interval_one' => $recurrenceIntervalOne,
            'recurrence_interval_two' => $recurrenceIntervalTwo,
            'notes' => $notes,
        ]);
    }

    /**
     * Modifies an existing Paystub.
     */
    public function modify(
        string $issuer,
        int $amountInCents,
        string $recurrenceRate,
        string $recurrenceIntervalOne,
        ?string $recurrenceIntervalTwo,
        ?string $notes
    ): Paystub {
        $this->update([
            'issuer' => $issuer,
            'amount_in_cents' => $amountInCents,
            'recurrence_rate' => $recurrenceRate,
            'recurrence_interval_one' => $recurrenceIntervalOne,
            'recurrence_interval_two' => $recurrenceIntervalTwo,
            'notes' => $notes,
        ]);

        return $this;
    }

    /**
     * Removes an existing Paystub.
     */
    public function remove(): void
    {
        $this->delete();
    }
}
