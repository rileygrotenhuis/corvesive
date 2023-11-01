<?php

namespace App\Http\v1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayPeriodRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ];
    }
}
