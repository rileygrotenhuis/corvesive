<?php

namespace App\Objects;

use App\Util\PayPeriodMetricsUtil;
use Illuminate\Support\Collection;

class PayPeriodMetricsObject
{
    public int $bills_total_payed;

    public int $bills_total_unpayed;

    public int $bills_total;

    public int $budgets_total_balance;

    public int $budgets_remaining_balance;

    public int $total_paystubs;

    public int $total_income;

    public int $bills_total_spent;

    public int $budgets_total_spent;

    public int $total_spent;

    public int $total_deposited;

    public int $current_surplus;

    public int $projected_surplus;

    public function __construct(
        public int $user_id,
        public int $pay_period_id,
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

        $this->bills_total_payed = $billMetrics['payed'];
        $this->bills_total_unpayed = $billMetrics['unpayed'];
        $this->bills_total = $billMetrics['total'];

        $this->budgets_total_balance = $budgetMetrics['total_balance'];
        $this->budgets_remaining_balance = $budgetMetrics['remaining_balance'];

        $this->total_paystubs = $incomeMetrics['paystubs_total'];
        $this->total_income = $incomeMetrics['total_income'];

        $this->bills_total_spent = $transactionMetrics['spent']['bills'];
        $this->budgets_total_spent = $transactionMetrics['spent']['budgets'];
        $this->total_spent = $transactionMetrics['spent']['total'];
        $this->total_deposited = $transactionMetrics['deposit'];

        $this->current_surplus = $surplusMetrics['current'];
        $this->projected_surplus = $surplusMetrics['projected'];
    }
}
