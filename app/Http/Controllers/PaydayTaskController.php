<?php

namespace App\Http\Controllers;

use App\Models\MonthlyExpense;
use App\Models\MonthlyPaystub;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PaydayTaskController extends Controller
{
    /**
     * Creates a new Payday Task on a Paystub
     * for a given Monthly Expense.
     */
    public function store(Request $request, MonthlyPaystub $monthlyPaystub): RedirectResponse
    {
        $request->validate([
            'monthly_expense_id' => ['required', 'exists:monthly_expenses,id'],
            'amount_in_cents' => ['required', 'integer'],
        ]);

        $monthlyExpense = MonthlyExpense::find($request->input('monthly_expense_id'));

        Gate::authorize('isOwner', $monthlyPaystub);
        Gate::authorize('isOwner', $monthlyExpense);

        $monthlyPaystub->newTask(
            $monthlyExpense,
            $request->input('amount_in_cents')
        );

        return back();
    }
}
