<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSavingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'balance' => 'required|integer|min:1',
        ];
    }
}
