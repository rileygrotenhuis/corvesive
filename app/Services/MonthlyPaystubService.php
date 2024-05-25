<?php

namespace App\Services;

use App\Models\MonthlyPaystub;
use App\Models\Paystub;
use App\Models\User;

class MonthlyPaystubService
{
    public function create(
        User $user,
        Paystub $paystub,
        int $year,
        int $month,
        string $payDay,
        int $amountInCents,
    ): MonthlyPaystub {
        // TODO: Validation Rules
        // TODO: Policies
        return MonthlyPaystub::query()->create([
            'user_id' => $user->id,
            'paystub_id' => $paystub->id,
            'year' => $year,
            'month' => $month,
            'pay_day' => $payDay,
            'amount_in_cents' => $amountInCents,
        ]);
    }

    public function update(
        MonthlyPaystub $monthlyPaystub,
        string $payDay,
        int $amountInCents,
    ): MonthlyPaystub {
        // TODO: Validation Rules
        // TODO: Policies
        $monthlyPaystub->update([
            'pay_day' => $payDay,
            'amount_in_cents' => $amountInCents,
        ]);

        return $monthlyPaystub;
    }

    public function delete(MonthlyPaystub $monthlyPaystub): void
    {
        $monthlyPaystub->delete();
    }
}
