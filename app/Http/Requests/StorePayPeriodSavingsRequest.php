<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPeriodSavingsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'saving_id' => ['required', 'exists:savings,id'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
