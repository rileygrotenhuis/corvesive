<?php

namespace App\Http\Controllers;

use App\Services\ExpenseBreakdownService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExpensesController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(Request $request)
    {
        $service = new ExpenseBreakdownService($request->user());

        return Inertia::render('Expenses/Index', [
            'expenseBreakdown' => $service->build(),
        ]);
    }
}
