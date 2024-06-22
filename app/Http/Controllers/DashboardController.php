<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use App\Repositories\SurplusRepository;
use Illuminate\Http\Request;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Dashboard - Index Page.
     */
    public function __invoke(Request $request): Response
    {
        $dashboardRepository = new DashboardRepository($request->user());
        $surplusRepository = new SurplusRepository($request->user());

        return inertia('Dashboard/Index', [
            'transactions' => $dashboardRepository->allTransactions(),
            'expenses' => [
                'total' => $dashboardRepository->totalExpenses(),
                'paid' => $dashboardRepository->paidExpenses(),
            ],
            'paystubs' => [
                'total' => $dashboardRepository->totalPaystubs(),
                'deposited' => $dashboardRepository->depositedPaystubs(),
            ],
            'surplus' => [
                'current' => $surplusRepository->currentSurplus(),
            ],
        ]);
    }
}
