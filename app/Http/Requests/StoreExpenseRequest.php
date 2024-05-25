<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'issuer' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'amount_in_cents' => ['required', 'integer', 'min:0'],
            'due_day_of_month' => ['required', 'integer', 'min:1', 'max:31'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
