<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBillRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'amount' => 'required|integer|min:1',
        ];
    }
}
