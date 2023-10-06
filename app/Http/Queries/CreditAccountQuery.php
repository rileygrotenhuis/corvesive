<?php

namespace App\Http\Queries;

use App\Models\CreditAccount;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class CreditAccountQuery extends QueryBuilder
{
    public function __construct($subject = null)
    {
        parent::__construct(
            $subject ?? CreditAccount::query()
        );

        $this->allowedFields([
            'user_id',
            'issuer',
            'name',
            'type',
            'credit_limit',
            'interest_rate',
            'annual_fee',
            'benefits',
            'notes',
        ]);

        $this->allowedIncludes([
            AllowedInclude::relationship('user'),
        ]);

        $this->allowedFilters([
            AllowedFilter::exact('user_id'),
            AllowedFilter::partial('issuer'),
            AllowedFilter::partial('name'),
            AllowedFilter::exact('type'),
            AllowedFilter::exact('credit_limit'),
            AllowedFilter::exact('interest_rate'),
            AllowedFilter::exact('annual_fee'),
        ]);

        $this->allowedSorts([
            AllowedSort::field('user_id'),
            AllowedSort::field('issuer'),
            AllowedSort::field('name'),
            AllowedSort::field('type'),
            AllowedSort::field('credit_limit'),
            AllowedSort::field('interest_rate'),
            AllowedSort::field('annual_fee'),
        ]);
    }
}
