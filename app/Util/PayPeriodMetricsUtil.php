<?php

namespace App\Util;

use Illuminate\Support\Collection;

class PayPeriodMetricsUtil
{
    public static function calculatePayPeriodSurplus(
        int $totalIncome,
        int $billsTotal,
        int $billsPayed,
        int $budgetsTotalBalance,
        int $budgetsRemainingBalance
    ): Collection {
        return collect([
            'current' => $totalIncome - $billsPayed - ($budgetsTotalBalance - $budgetsRemainingBalance),
            'projected' => $totalIncome - $billsTotal - $budgetsTotalBalance,
        ]);
    }
}
