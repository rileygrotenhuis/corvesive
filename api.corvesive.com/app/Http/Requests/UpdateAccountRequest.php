<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'string|regex:/^[0-9]{10,15}$/|max:20',
            'pay_period_id' => 'required|exists:pay_periods,id',
        ];
    }
}
