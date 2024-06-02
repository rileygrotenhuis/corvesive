<?php

namespace App\Http\Requests\Expenses;

use Illuminate\Foundation\Http\FormRequest;

class MonthlyExpensePaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_date' => ['required', 'date'],
            'amount_in_cents' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
