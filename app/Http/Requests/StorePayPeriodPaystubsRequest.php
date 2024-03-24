<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPeriodPaystubsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'paystub_id' => ['required', 'exists:paystubs,id'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
