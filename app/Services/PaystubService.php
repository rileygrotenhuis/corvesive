<?php

namespace App\Services;

use App\Models\Paystub;
use App\Models\User;

class PaystubService
{
    public function create(
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

    public function update(
        Paystub $paystub,
        string $issuer,
        int $amountInCents,
        string $recurrenceRate,
        string $recurrenceIntervalOne,
        ?string $recurrenceIntervalTwo,
        ?string $notes
    ): Paystub {
        $paystub->update([
            'issuer' => $issuer,
            'amount_in_cents' => $amountInCents,
            'recurrence_rate' => $recurrenceRate,
            'recurrence_interval_one' => $recurrenceIntervalOne,
            'recurrence_interval_two' => $recurrenceIntervalTwo,
            'notes' => $notes,
        ]);

        return $paystub;
    }

    public function delete(Paystub $paystub): void
    {
        $paystub->delete();
    }
}
