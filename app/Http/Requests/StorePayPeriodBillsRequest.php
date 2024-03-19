<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPeriodBillsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'bills' => ['required', 'array'],
            'bills.*.id' => ['required', 'exists:bills,id'],
            'bills.*.amount' => ['required', 'numeric', 'min:0'],
            'bills.*.due_date' => ['required', 'date'],
        ];
    }
}
