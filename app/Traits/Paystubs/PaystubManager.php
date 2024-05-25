<?php

namespace App\Traits\Paystubs;

use App\Events\Paystubs\PaystubCreated;
use App\Events\Paystubs\PaystubModified;
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
        $paystub = Paystub::query()->create([
            'user_id' => $user->id,
            'issuer' => $issuer,
            'amount_in_cents' => $amountInCents,
            'recurrence_rate' => $recurrenceRate,
            'recurrence_interval_one' => $recurrenceIntervalOne,
            'recurrence_interval_two' => $recurrenceIntervalTwo,
            'notes' => $notes,
        ]);

        event(new PaystubCreated($paystub));

        return $paystub;
    }

    /**
     * Modifies an existing Paystub.
     */
    public function modify(
        Paystub $paystub,
        string $issuer,
        int $amountInCents,
        string $recurrenceRate,
        string $recurrenceIntervalOne,
        ?string $recurrenceIntervalTwo,
        ?string $notes
    ): Paystub {
        $amountChanged = $paystub->amount_in_cents !== $amountInCents;

        $paystub->update([
            'issuer' => $issuer,
            'amount_in_cents' => $amountInCents,
            'recurrence_rate' => $recurrenceRate,
            'recurrence_interval_one' => $recurrenceIntervalOne,
            'recurrence_interval_two' => $recurrenceIntervalTwo,
            'notes' => $notes,
        ]);

        if ($amountChanged) {
            event(new PaystubModified($paystub));
        }

        return $paystub;
    }

    /**
     * Removes an existing Paystub.
     */
    public function remove(Paystub $paystub): void
    {
        $paystub->delete();
    }
}
