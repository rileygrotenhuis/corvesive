<?php

namespace App\Traits\Paystubs;

use App\Events\Paystubs\PaystubCreated;
use App\Events\Paystubs\PaystubModified;
use App\Models\MonthlyPaystub;
use App\Models\Paystub;
use App\Models\User;

trait PaystubManager
{
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

    public function remove(Paystub $paystub): void
    {
        $paystub->delete();
    }

    public function schedule(
        Paystub $paystub,
        int $year,
        int $month,
        string $payDay,
        int $amountInCents
    ): MonthlyPaystub {
        // TODO: Validation Rules
        // TODO: Policies

        return MonthlyPaystub::query()->create([
            'user_id' => $paystub->user_id,
            'paystub_id' => $paystub->id,
            'year' => $year,
            'month' => $month,
            'pay_day' => $payDay,
            'amount_in_cents' => $amountInCents,
        ]);
    }

    public function generateFutureExpenses(Paystub $paystub): void
    {
        // TODO: Logic
    }

    public function modifyFuturePaystubs(Paystub $paystub): void
    {
        $today = now()->format('Y-m-d');

        MonthlyPaystub::query()
            ->where('paystub_id', $paystub->id)
            ->where('pay_date', '>=', $today)
            ->update([
                'amount_in_cents' => $paystub->amount_in_cents,
            ]);
    }
}
