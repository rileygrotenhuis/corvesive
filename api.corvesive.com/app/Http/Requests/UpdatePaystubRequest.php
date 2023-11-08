<?php

namespace App\Http\Requests;

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
