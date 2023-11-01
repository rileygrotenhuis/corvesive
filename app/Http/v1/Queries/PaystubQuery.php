<?php

namespace App\Http\v1\Queries;

use App\Models\Paystub;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class PaystubQuery extends QueryBuilder
{
    public function __construct($subject = null)
    {
        parent::__construct(
            $subject ?? Paystub::query()
        );

        $this->allowedFields([
            'user_id',
            'issuer',
            'type',
            'amount',
            'notes',
        ]);

        $this->allowedIncludes([
            AllowedInclude::relationship('user'),
            AllowedInclude::relationship('payPeriods'),
        ]);

        $this->allowedFilters([
            AllowedFilter::exact('user_id'),
            AllowedFilter::partial('issuer'),
            AllowedFilter::exact('type'),
            AllowedFilter::exact('amount'),
        ]);

        $this->allowedSorts([
            AllowedSort::field('user_id'),
            AllowedSort::field('issuer'),
            AllowedSort::field('type'),
            AllowedSort::field('amount'),
        ]);
    }
}
