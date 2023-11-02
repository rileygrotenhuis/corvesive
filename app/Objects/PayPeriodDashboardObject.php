<?php

namespace App\Objects;

use Illuminate\Support\Collection;

class PayPeriodDashboardObject
{
    public function __construct(
        public Collection $upcoming_bills,
        public Collection $remaining_budgets,
    ) {
    }
}
