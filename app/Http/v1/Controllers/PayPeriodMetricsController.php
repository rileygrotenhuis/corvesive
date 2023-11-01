<?php

namespace App\Http\v1\Controllers;

use App\Http\v1\Resources\PayPeriodMetricResource;
use App\Models\PayPeriod;
use App\Models\PayPeriodMetric;
use App\Objects\PayPeriodMetricsObject;
use App\Repositories\PayPeriodMetricsRepository;

class PayPeriodMetricsController extends Controller
{
    public function index(PayPeriod $payPeriod): PayPeriodMetricResource
    {
        if ($payPeriod->is_complete) {
            return new PayPeriodMetricResource(
                PayPeriodMetric::where('user_id', auth()->user()->id)
                ->where('pay_period_id', $payPeriod->id)
                ->first()
            );
        }

        $payPeriodMetricsRepository = (new PayPeriodMetricsRepository($payPeriod));

        return new PayPeriodMetricResource(
            new PayPeriodMetricsObject(
                auth()->user()->id,
                $payPeriod->id,
                $payPeriodMetricsRepository->getBillMetrics(),
                $payPeriodMetricsRepository->getBudgetMetrics(),
                $payPeriodMetricsRepository->getIncomeMetrics(),
                $payPeriodMetricsRepository->getTransactionMetrics()
            )
        );
    }
}
