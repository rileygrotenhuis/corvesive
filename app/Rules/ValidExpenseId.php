<?php

namespace App\Rules;

use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use Illuminate\Contracts\Validation\Rule;

class ValidExpenseId implements Rule
{
    public function __construct(protected ?string $expenseType)
    {
    }

    public function passes($attribute, $value): bool
    {
        if ($this->expenseType === 'budget') {
            return PayPeriodBudget::find($value) !== null;
        }

        if ($this->expenseType === 'bill') {
            return PayPeriodBill::find($value) !== null;
        }

        return false;
    }

    public function message(): string
    {
        return 'No expense with this ID exists in our records.';
    }
}
