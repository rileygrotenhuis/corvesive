<?php

namespace App\Http\Controllers\PayPeriods;

use App\Http\Controllers\Controller;
use App\Http\Resources\PayPeriods\PayPeriodResource;
use App\Models\PayPeriod;
use App\Services\PayPeriods\PayPeriodMetricService;

class PayPeriodCompleteController extends Controller
{
    public function complete(PayPeriod $payPeriod): PayPeriodResource
    {
        $this->authorize('update', $payPeriod);

        $payPeriod->is_complete = 1;
        $payPeriod->save();

        (new PayPeriodMetricService())->savePayPeriodMetrics($payPeriod);

        return new PayPeriodResource($payPeriod);
    }

    public function incomplete(PayPeriod $payPeriod): PayPeriodResource
    {
        $this->authorize('update', $payPeriod);

        $payPeriod->is_complete = 0;
        $payPeriod->save();

        return new PayPeriodResource($payPeriod);
    }
}
