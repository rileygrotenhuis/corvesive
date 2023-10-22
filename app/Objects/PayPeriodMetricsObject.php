<?php

namespace App\Objects;

use App\Util\CurrencyUtil;
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
        $surplusMetrics = PayPeriodMetricsUtil::calculatePayPeriodSurplus(
            $this->incomeMetrics['total_income'],
            $this->transactionMetrics['spent']['total'],
            $this->billMetrics['total'],
            $this->budgetMetrics['total_balance']
        );

        return collect([
            'bill_metrics' => [
                'total_payed' => CurrencyUtil::formatCurrencyValues($this->billMetrics['payed']),
                'total_unpayed' => CurrencyUtil::formatCurrencyValues($this->billMetrics['unpayed']),
                'total' => CurrencyUtil::formatCurrencyValues($this->billMetrics['total']),
            ],
            'budget_metrics' => [
                'total_balance' => CurrencyUtil::formatCurrencyValues($this->budgetMetrics['total_balance']),
                'remaining_balance' => CurrencyUtil::formatCurrencyValues($this->budgetMetrics['remaining_balance']),
            ],
            'income_metrics' => [
                'total_income' => CurrencyUtil::formatCurrencyValues($this->incomeMetrics['total_income']),
                'paystubs_total' => CurrencyUtil::formatCurrencyValues($this->incomeMetrics['paystubs_total']),
            ],
            'transaction_metrics' => [
                'total_spent' => [
                    'bills' => CurrencyUtil::formatCurrencyValues($this->transactionMetrics['spent']['bills']),
                    'budgets' => CurrencyUtil::formatCurrencyValues($this->transactionMetrics['spent']['budgets']),
                    'total' => CurrencyUtil::formatCurrencyValues($this->transactionMetrics['spent']['total']),
                ],
                'total_deposited' => CurrencyUtil::formatCurrencyValues($this->transactionMetrics['deposit']),
            ],
            'surplus_metrics' => [
                'current' => CurrencyUtil::formatCurrencyValues($surplusMetrics['current']),
                'projected' => CurrencyUtil::formatCurrencyValues($surplusMetrics['projected']),
            ],
        ]);
    }
}
