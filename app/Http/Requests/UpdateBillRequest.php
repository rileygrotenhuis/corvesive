<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBillRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'issuer' => 'required|string',
            'name' => 'required|string',
            'amount' => 'required|integer|min:0',
            'due_date' => 'required|integer|min:1|max:31',
            'notes' => 'nullable|string',
        ];
    }
}
