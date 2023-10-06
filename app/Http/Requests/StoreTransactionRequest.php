<?php

namespace App\Http\Requests;

use App\Rules\ValidExpenseId;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'expense_type' => 'required|in:budget,bill',
            'expense_id' => [
                'required',
                'integer',
                new ValidExpenseId($this->input('expense_type')),
            ],
            'amount' => 'required_if:expense_type,budget|nullable|integer',
        ];
    }
}
