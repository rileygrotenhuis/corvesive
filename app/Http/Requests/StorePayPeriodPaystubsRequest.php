<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPeriodPaystubsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'paystubs' => ['required', 'array'],
            'paystubs.*.id' => ['required', 'exists:paystubs,id'],
            'paystubs.*.amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
