<?php

namespace App\Services;

use App\Models\PayPeriodPaystub;
use App\Models\Paystub;

class PaystubService
{
    public function createPaystub(
        int $userId,
        string $issuer,
        ?string $type,
        int $amount,
        ?string $notes,
    ): Paystub {
        $paystub = new Paystub();
        $paystub->user_id = $userId;
        $paystub->issuer = $issuer;
        $paystub->type = $type;
        $paystub->amount = $amount;
        $paystub->notes = $notes;
        $paystub->save();

        return $paystub;
    }

    public function updatePaystub(
        Paystub $paystub,
        string $issuer,
        ?string $type,
        int $amount,
        ?string $notes
    ): Paystub {
        $paystub->issuer = $issuer;
        $paystub->type = $type;
        $paystub->amount = $amount;
        $paystub->notes = $notes;
        $paystub->save();

        return $paystub;
    }

    public function deletePaystub(Paystub $paystub): bool
    {
        $this->removeAttachedPayPeriodPaystubs($paystub);

        return $paystub->delete();
    }

    protected function removeAttachedPayPeriodPaystubs(Paystub $paystub): void
    {
        PayPeriodPaystub::where('paystub_id', $paystub->id)->delete();
    }
}
