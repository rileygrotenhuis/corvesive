<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayPeriodRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'total_balance' => 'required|integer|min:1',
        ];
    }
}
