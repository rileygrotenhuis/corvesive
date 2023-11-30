<?php

namespace App\Objects;

class RecurringMetricsObject
{
    public int $expenses_total;

    public int $projected_surplus;

    public function __construct(
        public int $paystubs_total,
        public int $bills_total,
        public int $budgets_total,
        public int $savings_total
    ) {
        $this->expenses_total = $this->bills_total + $this->budgets_total + $this->savings_total;
        $this->projected_surplus = $this->paystubs_total - $this->expenses_total;
    }
}
