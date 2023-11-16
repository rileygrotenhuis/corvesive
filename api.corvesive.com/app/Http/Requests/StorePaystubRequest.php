<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaystubRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'issuer' => 'required|string|max:255',
            'type' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
