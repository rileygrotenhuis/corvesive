<?php

namespace App\Http\Controllers;

use App\Repositories\MonthlyExpenseBreakdown;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExpensesController extends Controller
{
    public function __invoke(Request $request)
    {
        $repository = new MonthlyExpenseBreakdown($request->user());

        return Inertia::Render('Expenses/Index', [
            'monthlyExpenseBreakdown' => $repository->getMonthlyExpensebreakdown(),
        ]);
    }
}
