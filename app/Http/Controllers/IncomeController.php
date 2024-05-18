<?php

namespace App\Http\Controllers;

use App\Services\IncomeBreakdownService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Objects\PieChart;

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
