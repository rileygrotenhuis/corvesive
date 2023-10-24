<?php

namespace App\Objects;

use App\Util\PayPeriodMetricsUtil;
use Illuminate\Support\Collection;

class PayPeriodMetricsObject
{
    public int $billsTotalPayed;

    public int $billsTotalUnpayed;

    public int $billsTotal;

    public int $budgetsTotalBalance;

    public int $budgetsRemainingBalance;

    public int $totalPaystubs;

    public int $totalIncome;

    public int $billsTotalSpent;

    public int $budgetsTotalSpent;

    public int $totalSpent;

    public int $totalDeposited;

    public int $currentSurplus;

    public int $projectedSurplus;

    public function __construct(
        public int $userId,
        public int $payPeriodId,
        Collection $billMetrics,
        Collection $budgetMetrics,
        Collection $incomeMetrics,
        Collection $transactionMetrics
    ) {
        $surplusMetrics = PayPeriodMetricsUtil::calculatePayPeriodSurplus(
            $incomeMetrics['total_income'],
            $transactionMetrics['spent']['total'],
            $billMetrics['total'],
            $budgetMetrics['total_balance']
        );

        $this->billsTotalPayed = $billMetrics['payed'];
        $this->billsTotalUnpayed = $billMetrics['unpayed'];
        $this->billsTotal = $billMetrics['total'];

        $this->budgetsTotalBalance = $budgetMetrics['total_balance'];
        $this->budgetsRemainingBalance = $budgetMetrics['remaining_balance'];

        $this->totalPaystubs = $incomeMetrics['paystubs_total'];
        $this->totalIncome = $incomeMetrics['total_income'];

        $this->billsTotalSpent = $transactionMetrics['spent']['bills'];
        $this->budgetsTotalSpent = $transactionMetrics['spent']['budgets'];
        $this->totalSpent = $transactionMetrics['spent']['total'];
        $this->totalDeposited = $transactionMetrics['deposit'];

        $this->currentSurplus = $surplusMetrics['current'];
        $this->projectedSurplus = $surplusMetrics['projected'];
    }
}
