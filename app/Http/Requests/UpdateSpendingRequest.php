<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpendingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'total_balance' => 'required|integer|min:0',
            'remaining_balance' => 'required|integer',
        ];
    }
}
