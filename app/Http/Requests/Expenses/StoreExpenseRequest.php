<?php

namespace App\Http\Requests\Expenses;

use App\Types\ExpenseTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExpenseRequest extends FormRequest
{
    use ExpenseTypes;

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', Rule::in(self::$EXPENSE_TYPES)],
            'issuer' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'amount_in_cents' => ['required', 'integer', 'min:0'],
            'due_day_of_month' => ['required', 'integer', 'min:1', 'max:28'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
