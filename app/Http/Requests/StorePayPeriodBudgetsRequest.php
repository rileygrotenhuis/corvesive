<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPeriodBudgetsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'budgets' => ['required', 'array'],
            'budgets.*.id' => ['required', 'exists:budgets,id'],
            'budgets.*.total_balance' => ['required', 'numeric', 'min:0'],
        ];
    }
}
