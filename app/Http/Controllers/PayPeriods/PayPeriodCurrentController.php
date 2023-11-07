<?php

namespace App\Http\Controllers\PayPeriods;

use App\Http\Controllers\Controller;
use App\Http\Resources\PayPeriods\PayPeriodResource;
use App\Models\PayPeriod;
use App\Models\User;

class PayPeriodCurrentController extends Controller
{
    public function store(PayPeriod $payPeriod): PayPeriodResource
    {
        $this->authorize('user', $payPeriod);

        $user = User::where(
            'id',
            auth()->user()->id
        )->first();

        $user->pay_period_id = $payPeriod->id;
        $user->save();

        return new PayPeriodResource($payPeriod);
    }
}
