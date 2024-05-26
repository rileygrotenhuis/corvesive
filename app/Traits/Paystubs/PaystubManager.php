<?php

namespace App\Traits\Paystubs;

use App\Events\Paystubs\PaystubCreated;
use App\Events\Paystubs\PaystubModified;
use App\Events\Paystubs\PaystubRescheduled;
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

        /**
         * Schedules future instances of this Paystub
         * for the next 12 months
         */
        event(new PaystubCreated($paystub));

        return $paystub;
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
        $amountChanged = $this->amount_in_cents !== $amountInCents;

        $recurrenceChanged = (
            $this->recurrence_rate !== $recurrenceRate ||
            $this->recurrence_interval_one !== $recurrenceIntervalOne ||
            $this->recurrence_interval_two !== $recurrenceIntervalTwo
        );

        $this->update([
            'issuer' => $issuer,
            'amount_in_cents' => $amountInCents,
            'recurrence_rate' => $recurrenceRate,
            'recurrence_interval_one' => $recurrenceIntervalOne,
            'recurrence_interval_two' => $recurrenceIntervalTwo,
            'notes' => $notes,
        ]);

        /**
         * If ONLY the amount value changed, modify all
         * future instances of this Paystub
         */
        if ($amountChanged && ! $recurrenceChanged) {
            event(new PaystubModified($this));
        }

        /**
         * If the recurrence changed, unschedule
         * and reschedule all future instances of this Paystub
         */
        if ($recurrenceChanged) {
            event(new PaystubRescheduled($this));
        }

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
