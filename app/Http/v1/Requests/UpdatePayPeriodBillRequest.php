<?php

namespace App\Http\v1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayPeriodBillRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => 'required|integer|min:1',
            'due_date' => 'required|date',
        ];
    }
}
