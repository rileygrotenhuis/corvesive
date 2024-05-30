<?php

namespace App\Http\Controllers;

use App\Models\MonthlyExpense;
use Inertia\Response;

class MonthlyExpenseController extends Controller
{
    /**
     * Monthly Expenses - Index Page.
     */
    public function index(MonthlyExpense $monthlyExpense): Response
    {
        $monthlyExpense->append([
            'amount_paid',
            'amount_remaining',
        ]);

        $monthlyExpense->load('expense');

        return inertia('Expenses/Due', [
            'monthlyExpense' => $monthlyExpense,
        ]);
    }
}
