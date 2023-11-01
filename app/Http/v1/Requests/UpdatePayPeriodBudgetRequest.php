<?php

namespace App\Http\v1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayPeriodBudgetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'total_balance' => 'required|integer|min:0',
            'remaining_balance' => 'required|integer',
        ];
    }
}
