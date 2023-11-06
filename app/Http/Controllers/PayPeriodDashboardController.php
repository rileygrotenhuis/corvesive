<?php

namespace App\Http\Controllers;

use App\Http\Resources\PayPeriodDashboardResource;
use App\Models\PayPeriod;
use App\Objects\PayPeriodDashboardObject;
use App\Repositories\PayPeriodDashboardRepository;
use Illuminate\Http\JsonResponse;

class PayPeriodDashboardController extends Controller
{
    public function index(PayPeriod $payPeriod): PayPeriodDashboardResource|JsonResponse
    {
        $payPeriodDashboardRepository = (new PayPeriodDashboardRepository($payPeriod));

        return new PayPeriodDashboardResource(
            new PayPeriodDashboardObject(
                $payPeriodDashboardRepository->getUpcomingBills(),
                $payPeriodDashboardRepository->getRemainingBudgets(),
                $payPeriodDashboardRepository->getTotalSpentToday(),
            )
        );
    }
}
