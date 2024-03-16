<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class IncomeController extends Controller
{
    public function __invoke(Request $request)
    {
        // $repository = new MonthlyExpenseBreakdown($request->user());

        return Inertia::Render('Income/Index', [
            // 'monthlyExpenseBreakdown' => $repository->getMonthlyExpensebreakdown(),
        ]);
    }
}
