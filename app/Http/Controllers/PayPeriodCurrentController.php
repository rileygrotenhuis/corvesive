<?php

namespace App\Http\Controllers;

use App\Http\Resources\PayPeriodResource;
use App\Models\PayPeriod;
use App\Models\User;

class PayPeriodCurrentController extends Controller
{
    public function store(PayPeriod $payPeriod): PayPeriodResource
    {
        $user = User::where(
            'id',
            auth()->user()->id
        )->first();

        $user->pay_period_id = $payPeriod->id;
        $user->save();

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }
}
