<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Collection;

class PayPeriodAttributesObject
{
    public function __construct(
        public Collection $payed_bills,
        public Collection $upcoming_bills,
        public Collection $overdue_bills,
        public Collection $remaining_budgets,
        public Collection $overpayed_budgets,
        public Collection $payed_budgets,
        public Collection $recent_transactions
    ) {
    }
}
