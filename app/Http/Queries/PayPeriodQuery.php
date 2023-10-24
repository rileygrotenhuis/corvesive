<?php

namespace App\Http\Queries;

use App\Models\PayPeriod;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class PayPeriodQuery extends QueryBuilder
{
    public function __construct($subject = null)
    {
        parent::__construct(
            $subject ?? PayPeriod::query()
        );

        $this->allowedFields([
            'user_id',
            'start_date',
            'end_date',
            'total_balance',
            'is_complete',
        ]);

        $this->allowedIncludes([
            AllowedInclude::relationship('user'),
            AllowedInclude::relationship('paystubs'),
            AllowedInclude::relationship('bills'),
            AllowedInclude::relationship('budgets'),
        ]);

        $this->allowedFilters([
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('start_date'),
            AllowedFilter::exact('end_date'),
            AllowedFilter::exact('total_balance'),
            AllowedFilter::exact('is_complete'),
        ]);

        $this->allowedSorts([
            AllowedSort::field('user_id'),
            AllowedSort::field('start_date'),
            AllowedSort::field('end_date'),
            AllowedSort::field('total_balance'),
            AllowedSort::field('is_complete'),
        ]);
    }
}
