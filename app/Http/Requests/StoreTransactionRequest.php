<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'transactionable_type' => ['nullable', 'in:App\Models\PayPeriodBill,App\Models\PayPeriodBudget,App\Models\PayPeriodSaving'],
            'transactionable_id' => ['nullable', 'integer'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
