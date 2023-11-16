<?php

namespace App\Http\Requests\PayPeriods;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayPeriodBudgetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'total_balance' => 'required|numeric|min:0',
            'remaining_balance' => 'required|numeric',
        ];
    }
}
