<?php

namespace App\Http\Queries;

use App\Models\Bill;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class BillQuery extends QueryBuilder
{
    public function __construct($subject = null)
    {
        parent::__construct(
            $subject ?? Bill::query()
        );

        $this->allowedFields([
            'user_id',
            'issuer',
            'name',
            'amount',
            'due_date',
            'notes',
        ]);

        $this->allowedIncludes([
            AllowedInclude::relationship('user'),
            AllowedInclude::relationship('payPeriods'),
        ]);

        $this->allowedFilters([
            AllowedFilter::exact('user_id'),
            AllowedFilter::partial('issuer'),
            AllowedFilter::partial('name'),
            AllowedFilter::exact('amount'),
            AllowedFilter::exact('due_date'),
        ]);

        $this->allowedSorts([
            AllowedSort::field('user_id'),
            AllowedSort::field('issuer'),
            AllowedSort::field('name'),
            AllowedSort::field('amount'),
            AllowedFilter::exact('due_date'),
        ]);
    }
}
