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

        logger($repository->totalDeposited());
        logger($repository->totalPaid());

        return inertia('Dashboard/Index');
    }
}
