<?php

namespace App\Http\Controllers;

use App\Models\PayPeriod;
use App\Repositories\PayPeriodMetricsRepository;
use Illuminate\Http\JsonResponse;

class PayPeriodMetricsController extends Controller
{
    public function index(PayPeriod $payPeriod): JsonResponse
    {
        return response()->json([
            'data' => (new PayPeriodMetricsRepository($payPeriod))->get(),
        ]);
    }
}
