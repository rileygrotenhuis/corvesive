<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Dashboard - Index Page.
     */
    public function __invoke(Request $request): Response
    {
        $repository = new DashboardRepository($request->user());

        return inertia('Dashboard/Index', [
            'transactions' => $repository->allTransactions(),
            'expenses' => [
                'total' => $repository->totalExpenses(),
                'paid' => $repository->paidExpenses(),
            ],
            'paystubs' => [
                'total' => $repository->totalPaystubs(),
                'deposited' => $repository->depositedPaystubs(),
            ],
        ]);
    }
}
