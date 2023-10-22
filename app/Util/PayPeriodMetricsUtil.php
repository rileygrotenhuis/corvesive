<?php

namespace App\Util;

use Illuminate\Support\Collection;

class PayPeriodMetricsUtil
{
    public static function calculatePayPeriodSurplus(
        int $totalIncome,
        int $totalSpent,
        int $billsTotal,
        int $budgetsTotal
    ): Collection {
        return collect([
            'current' => $totalIncome - $totalSpent,
            'projected' => $totalIncome - $billsTotal - $budgetsTotal,
        ]);
    }
}
