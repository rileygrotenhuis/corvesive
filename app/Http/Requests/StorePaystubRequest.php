<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaystubRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'issuer' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'issued_days_of_month' => ['required', 'array'],
            'issued_days_of_month.*' => ['required', 'integer', 'min:1', 'max:31'],
            'notes' => ['nullable', 'string', 'max:255'],
        ];
    }
}
