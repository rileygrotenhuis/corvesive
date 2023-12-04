<?php

namespace App\Http\Controllers\PayPeriods;

use App\Http\Resources\PayPeriods\PayPeriodMetricsResource;
use App\Models\PayPeriod;
use App\Objects\PayPeriodMetricsObject;
use App\Repositories\PayPeriodMetricsRepository;

class PayPeriodMetricsController
{
    public function __invoke(PayPeriod $payPeriod): PayPeriodMetricsResource
    {
        $repository = new PayPeriodMetricsRepository($payPeriod);

        return new PayPeriodMetricsResource(
            new PayPeriodMetricsObject(
                $repository->getPaystubsTotal(),
                $repository->getDepositsTotal(),
                $repository->getPaymentsTotal(),
                $repository->getPayedBillsTotal(),
                $repository->getUnpayedBillsTotal(),
                $repository->getBudgetsBalanceTotal(),
                $repository->getRemainingBudgetsTotal(),
                $repository->getSavingsTotal()
            )
        );
    }
}
