<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreditAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'issuer' => 'required|string',
            'name' => 'required|string',
            'type' => 'required|in:visa,mastercard,amex,other',
            'credit_limit' => 'required|integer|min:0',
            'interest_rate' => 'required|numeric|between:0,1',
            'annual_fee' => 'integer|min:0',
            'benefits' => 'string',
            'notes' => 'string',
        ];
    }
}
