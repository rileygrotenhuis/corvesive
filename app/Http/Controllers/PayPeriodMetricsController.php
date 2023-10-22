<?php

namespace App\Http\Controllers;

use App\Models\PayPeriod;
use App\Objects\PayPeriodMetricsObject;
use App\Repositories\PayPeriodMetricsRepository;
use Illuminate\Http\JsonResponse;

class PayPeriodMetricsController extends Controller
{
    public function index(PayPeriod $payPeriod): JsonResponse
    {
        $payPeriodMetricsRepository = (new PayPeriodMetricsRepository($payPeriod));

        return response()->json([
            'data' => (new PayPeriodMetricsObject(
                $payPeriodMetricsRepository->getBillMetrics(),
                $payPeriodMetricsRepository->getBudgetMetrics(),
                $payPeriodMetricsRepository->getIncomeMetrics(),
                $payPeriodMetricsRepository->getTransactionMetrics()
            ))->get(),
        ]);
    }
}
