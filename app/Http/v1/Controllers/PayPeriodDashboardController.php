<?php

namespace App\Http\v1\Controllers;

use App\Http\v1\Resources\PayPeriodBillResource;
use App\Http\v1\Resources\PayPeriodBudgetResource;
use App\Models\PayPeriod;
use App\Repositories\PayPeriodDashboardRepository;
use Illuminate\Http\JsonResponse;

class PayPeriodDashboardController extends Controller
{
    public function index(PayPeriod $payPeriod): JsonResponse
    {
        $payPeriodDashboardRepository = (new PayPeriodDashboardRepository($payPeriod));

        return response()->json([
            'upcoming_bills' => PayPeriodBillResource::collection(
                $payPeriodDashboardRepository->getUpcomingBills()
            ),
            'remaining_budgets' => PayPeriodBudgetResource::collection(
                $payPeriodDashboardRepository->getRemainingBudgets()
            ),
        ]);
    }
}
