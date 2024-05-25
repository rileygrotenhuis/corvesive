<?php

namespace App\Services;

use App\Models\MonthlyPaystub;

class MonthlyPaystubService
{
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
