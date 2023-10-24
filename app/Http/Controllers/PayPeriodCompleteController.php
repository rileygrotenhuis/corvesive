<?php

namespace App\Http\Controllers;

use App\Models\PayPeriod;
use Illuminate\Http\JsonResponse;

class PayPeriodCompleteController extends Controller
{
    public function complete(PayPeriod $payPeriod): JsonResponse
    {
        $this->authorize('update', $payPeriod);

        return response()->json('', 204);
    }

    public function incomplete(PayPeriod $payPeriod): JsonResponse
    {
        $this->authorize('update', $payPeriod);

        return response()->json('', 204);
    }
}
