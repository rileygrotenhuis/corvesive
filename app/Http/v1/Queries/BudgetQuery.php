<?php

namespace App\Http\v1\Queries;

use App\Models\Budget;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class BudgetQuery extends QueryBuilder
{
    public function __construct($subject = null)
    {
        parent::__construct(
            $subject ?? Budget::query()
        );

        $this->allowedFields([
            'user_id',
            'name',
            'amount',
            'notes',
        ]);

        $this->allowedIncludes([
            AllowedInclude::relationship('user'),
            AllowedInclude::relationship('payPeriods'),
        ]);

        $this->allowedFilters([
            AllowedFilter::exact('user_id'),
            AllowedFilter::partial('name'),
            AllowedFilter::exact('amount'),
        ]);

        $this->allowedSorts([
            AllowedSort::field('user_id'),
            AllowedSort::field('name'),
            AllowedSort::field('amount'),
        ]);
    }
}
