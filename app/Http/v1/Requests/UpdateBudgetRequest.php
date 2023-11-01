<?php

namespace App\Http\v1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBudgetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'amount' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
