<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPeriodBudgetsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'budget_id' => ['required', 'exists:monthly_budgets,id'],
            'total_balance' => ['required', 'numeric', 'min:0'],
        ];
    }
}
