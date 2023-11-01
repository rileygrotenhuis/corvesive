<?php

namespace App\Http\v1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaystubRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'issuer' => 'required|string|max:255',
            'amount' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
