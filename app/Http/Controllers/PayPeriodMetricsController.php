<?php

namespace App\Http\Controllers;

use App\Http\Resources\PayPeriodMetricResource;
use App\Models\PayPeriod;
use App\Objects\PayPeriodMetricsObject;
use App\Repositories\PayPeriodMetricsRepository;

class PayPeriodMetricsController extends Controller
{
    public function index(PayPeriod $payPeriod): PayPeriodMetricResource
    {
        $payPeriodMetricsRepository = (new PayPeriodMetricsRepository($payPeriod));

        return new PayPeriodMetricResource(new PayPeriodMetricsObject(
            auth()->user()->id,
            $payPeriod->id,
            $payPeriodMetricsRepository->getBillMetrics(),
            $payPeriodMetricsRepository->getBudgetMetrics(),
            $payPeriodMetricsRepository->getIncomeMetrics(),
            $payPeriodMetricsRepository->getTransactionMetrics()
        ));
    }
}
