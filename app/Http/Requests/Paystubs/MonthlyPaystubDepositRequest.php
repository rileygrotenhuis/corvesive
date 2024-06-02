<?php

namespace App\Http\Requests\Paystubs;

use Illuminate\Foundation\Http\FormRequest;

class MonthlyPaystubDepositRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'deposit_date' => ['required', 'date'],
            'amount_in_cents' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
