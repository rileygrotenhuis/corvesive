<?php

namespace App\Http\Controllers;

use App\Services\ExpenseBreakdownService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Rileygrotenhuis\Ripcord\Charts\PieChart;

class ExpensesController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(Request $request)
    {
        $service = new ExpenseBreakdownService($request->user());

        $chart = new PieChart(
            $service->getChartLabels(),
            $service->getChartData()
        );

        return Inertia::render('Expenses/Index', [
            'chart' => $chart->build(),
            'card' => $service->getCardData(),
        ]);
    }
}
