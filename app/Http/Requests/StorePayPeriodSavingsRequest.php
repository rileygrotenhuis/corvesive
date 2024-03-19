<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPeriodSavingsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'savings' => ['required', 'array'],
            'savings.*.id' => ['required', 'exists:savings,id'],
            'savings.*.amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
