<?php

namespace App\Http\v1\Controllers;

use App\Http\v1\Resources\PayPeriodDashboardResource;
use App\Objects\PayPeriodDashboardObject;
use App\Repositories\PayPeriodDashboardRepository;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->payPeriod) {
            $payPeriodDashboardRepository = (new PayPeriodDashboardRepository(auth()->user()->payPeriod));

            return new PayPeriodDashboardResource(
                new PayPeriodDashboardObject(
                    $payPeriodDashboardRepository->getUpcomingBills(),
                    $payPeriodDashboardRepository->getRemainingBudgets()
                )
            );
        }

        return response()->json([
            'errors' => [
                'No Pay Period has been selected for this user'
            ]
        ], 422);
    }
}
