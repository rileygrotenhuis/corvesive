<?php

namespace App\Services;

use App\Models\Spending;

class SpendingService
{
    public function createSpending(
        int $userId,
        int $payPeriodId,
        int $totalBalance
    ): Spending {
        $spending = new Spending();
        $spending->user_id = $userId;
        $spending->pay_period_id = $payPeriodId;
        $spending->total_balance = $totalBalance;
        $spending->remaining_balance = $totalBalance;
        $spending->save();

        return $spending;
    }

    public function updateSpending(
        Spending $spending,
        int $totalBalance,
        int $remainingBalance
    ): Spending {
        $spending->total_balance = $totalBalance;
        $spending->remaining_balance = $remainingBalance;
        $spending->save();

        return $spending;
    }

    public function deleteSpending(
        Spending $spending
    ): bool {
        return $spending->delete();
    }
}
