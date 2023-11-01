<?php

namespace App\Http\v1\Controllers;

use App\Http\v1\Resources\MonthlyMetricResource;
use App\Objects\MonthlyMetricsObject;
use App\Repositories\MonthlyMetricsRepository;

class MonthlyMetricsController extends Controller
{
    public function index(): MonthlyMetricResource
    {
        $monthlyMetricsRepository = new MonthlyMetricsRepository(auth()->user());

        return new MonthlyMetricResource(
            new MonthlyMetricsObject(
                $monthlyMetricsRepository->getPaystubsTotal(),
                $monthlyMetricsRepository->getBillsTotal(),
                $monthlyMetricsRepository->getBudgetsTotal()
            )
        );
    }
}
