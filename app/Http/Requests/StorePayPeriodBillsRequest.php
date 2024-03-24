<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPeriodBillsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'bill_id' => ['required', 'exists:monthly_bills,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['required', 'date'],
        ];
    }
}
