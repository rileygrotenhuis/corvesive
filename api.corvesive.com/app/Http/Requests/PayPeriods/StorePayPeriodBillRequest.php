<?php

namespace App\Http\Requests\PayPeriods;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPeriodBillRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => 'required|integer|min:1',
            'due_date' => 'required|date',
            'is_automatic' => 'required|boolean',
        ];
    }
}
