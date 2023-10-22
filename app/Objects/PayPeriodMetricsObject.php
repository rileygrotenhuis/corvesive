<?php

namespace App\Objects;

use App\Util\PayPeriodMetricsUtil;
use Illuminate\Support\Collection;

class PayPeriodMetricsObject
{
    public function __construct(
        protected Collection $billMetrics,
        protected Collection $budgetMetrics,
        protected Collection $incomeMetrics,
        protected Collection $transactionMetrics
    ) {
    }

    public function get(): Collection
    {
        return collect([
            'bill_metrics' => $this->billMetrics,
            'budget_metrics' => $this->budgetMetrics,
            'income_metrics' => $this->incomeMetrics,
            'transaction_metrics' => $this->transactionMetrics,
            'surplus_metrics' => PayPeriodMetricsUtil::calculatePayPeriodSurplus(
                $this->incomeMetrics['total_income'],
                $this->transactionMetrics['spent']['total'],
                $this->billMetrics['total'],
                $this->budgetMetrics['total_balance']
            ),
        ]);
    }
}
