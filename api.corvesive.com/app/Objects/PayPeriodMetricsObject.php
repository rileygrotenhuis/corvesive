<?php

namespace App\Objects;

class PayPeriodMetricsObject
{
    public int $income_total;

    public int $bills_total;

    public int $budgets_spent_total;

    public int $spent_total;

    public int $remaining_total;

    public int $expenses_total;

    public int $surplus_total;

    public function __construct(
        public int $paystubs_total,
        public int $deposits_total,
        public int $payed_bills_total,
        public int $unpayed_bills_total,
        public int $budgets_balance_total,
        public int $remaining_budgets_total,
        public int $savings_total
    ) {
        $this->income_total = $this->paystubs_total + $this->deposits_total;
        $this->bills_total = $this->payed_bills_total + $this->unpayed_bills_total;
        $this->budgets_spent_total = $this->budgets_balance_total - $this->remaining_budgets_total;
        $this->spent_total = $this->budgets_spent_total + $this->payed_bills_total;
        $this->remaining_total = $this->remaining_budgets_total + $this->unpayed_bills_total;
        $this->expenses_total = $this->budgets_balance_total + $this->bills_total + $this->savings_total;
        $this->surplus_total = $this->expenses_total + $this->income_total;
    }
}
