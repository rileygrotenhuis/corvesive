<?php

namespace App\Http\Controllers;

use App\Models\MonthlyExpense;
use App\Models\MonthlyPaystub;
use App\Models\PaydayTask;
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

    /**
     * Modifies the amount of a Payday Task.
     */
    public function update(Request $request, PaydayTask $paydayTask): RedirectResponse
    {
        Gate::authorize('isOwner', $paydayTask->monthlyPaystub);

        $request->validate([
            'amount_in_cents' => ['required', 'integer'],
        ]);

        $paydayTask->modifytask($request->input('amount_in_cents'));

        return back();
    }

    /**
     * Deletes a Payday Task.
     */
    public function destroy(PaydayTask $paydayTask): RedirectResponse
    {
        Gate::authorize('isOwner', $paydayTask->monthlyPaystub);

        $paydayTask->removeTask();

        return back();
    }

    /**
     * Completes a Payday Task
     * and pays it off
     */
    public function complete(PaydayTask $paydayTask): RedirectResponse
    {
        Gate::authorize('isOwner', $paydayTask->monthlyPaystub);

        $paydayTask->completeTask();

        return back();
    }
}
