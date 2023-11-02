<?php

namespace App\Http\v1\Controllers;

use App\Http\v1\Resources\PayPeriodDashboardResource;
use App\Models\PayPeriod;
use App\Objects\PayPeriodDashboardObject;
use App\Repositories\PayPeriodDashboardRepository;

class PayPeriodDashboardController extends Controller
{
    public function index(PayPeriod $payPeriod): PayPeriodDashboardResource
    {
        $payPeriodDashboardRepository = (new PayPeriodDashboardRepository($payPeriod));

        return new PayPeriodDashboardResource(
            new PayPeriodDashboardObject(
                $payPeriodDashboardRepository->getUpcomingBills(),
                $payPeriodDashboardRepository->getRemainingBudgets()
            )
        );
    }
}
