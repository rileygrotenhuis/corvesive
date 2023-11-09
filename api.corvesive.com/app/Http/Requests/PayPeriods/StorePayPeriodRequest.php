<?php

namespace App\Http\Requests\PayPeriods;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPeriodRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'auto_generate_resources' => 'nullable|boolean',
        ];
    }
}
