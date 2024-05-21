<?php

namespace App\Http\Controllers;

use App\Objects\PieChart;
use App\Services\IncomeBreakdownService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IncomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $service = new IncomeBreakdownService($request->user());

        $chart = new PieChart(
            $service->getChartLabels(),
            $service->getChartData()
        );

        return Inertia::render('Income/Index', [
            'card' => $service->getCardData(),
            'chart' => $chart->build(),
        ]);
    }
}
