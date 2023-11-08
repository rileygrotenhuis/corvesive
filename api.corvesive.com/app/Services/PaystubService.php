<?php

namespace App\Services;

use App\Models\Paystub;

class PaystubService
{
    public function createPaystub(
        int $userId,
        string $issuer,
        int $amount,
        ?string $notes,
    ): Paystub {
        $paystub = new Paystub();
        $paystub->user_id = $userId;
        $paystub->issuer = $issuer;
        $paystub->amount = $amount;
        $paystub->notes = $notes;
        $paystub->save();

        return $paystub;
    }

    public function updatePaystub(
        Paystub $paystub,
        string $issuer,
        int $amount,
        ?string $notes
    ): Paystub {
        $paystub->issuer = $issuer;
        $paystub->amount = $amount;
        $paystub->notes = $notes;
        $paystub->save();

        return $paystub;
    }

    public function deletePaystub(Paystub $paystub): bool
    {
        return $paystub->delete();
    }
}
