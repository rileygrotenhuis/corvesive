<?php

namespace App\Http\Controllers\PayPeriods;

use App\Http\Resources\PayPeriods\PayPeriodAttributesResource;
use App\Models\PayPeriod;
use App\Objects\PayPeriodAttributesObject;
use App\Repositories\PayPeriodAttributesRepository;

class PayPeriodAttributesController
{
    public function __invoke(PayPeriod $payPeriod): PayPeriodAttributesResource
    {
        $repository = new PayPeriodAttributesRepository($payPeriod);

        return new PayPeriodAttributesResource(
            new PayPeriodAttributesObject(
                $repository->getPayedBills(),
                $repository->getUpcomingBills(),
                $repository->getOverdueBills(),
                $repository->getRemainingBudgets(),
                $repository->getOverpayedBudgets(),
                $repository->getPayedBudgets(),
                $repository->getRecentTransactions()
            )
        );
    }
}
