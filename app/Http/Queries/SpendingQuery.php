<?php

namespace App\Http\Queries;

use App\Models\Spending;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class SpendingQuery extends QueryBuilder
{
    public function __construct($subject = null)
    {
        parent::__construct(
            $subject ?? Spending::query()
        );

        $this->allowedFields([
            'user_id',
            'pay_period_id',
            'total_balance',
            'remaining_balance',
        ]);

        $this->allowedIncludes([
            AllowedInclude::relationship('user'),
            AllowedInclude::relationship('payPeriod'),
        ]);

        $this->allowedFilters([
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('pay_period_id'),
            AllowedFilter::exact('total_balance'),
            AllowedFilter::exact('remaining_balance'),
        ]);

        $this->allowedSorts([
            AllowedSort::field('user_id'),
            AllowedSort::field('pay_period_id'),
            AllowedSort::field('total_balance'),
            AllowedSort::field('remaining_balance'),
        ]);
    }
}
