<?php

namespace App\Http\Controllers\Expenses;

use App\Events\Expenses\ExpenseCreated;
use App\Events\Expenses\ExpenseModified;
use App\Events\Expenses\ExpenseRescheduled;
use App\Helpers\DateHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Expenses\StoreExpenseRequest;
use App\Http\Requests\Expenses\UpdateExpenseRequest;
use App\Models\Expense;
use App\Repositories\ExpenseRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Response;

class ExpenseController extends Controller
{
    /**
     * Expenses - Index Page.
     */
    public function index(Request $request): Response
    {
        $repository = new ExpenseRepository($request->user());

        $allExpenses = $repository->all();
        $monthlyExpenses = $repository->monthly()->groupBy('monthYear');

        $monthSelectionOptions = DateHelpers::getMonthlySelectionOptions();

        return inertia('Expenses/Index', [
            'expenses' => $allExpenses,
            'monthlyExpenses' => $monthlyExpenses,
            'monthSelectionOptions' => $monthSelectionOptions,
        ]);
    }

    /**
     * Expenses - Create Page.
     */
    public function create(): Response
    {
        return inertia('Expenses/Create');
    }

    /**
     * Creates a new Expense.
     */
    public function store(StoreExpenseRequest $request): RedirectResponse
    {
        $expense = Expense::add(
            $request->user(),
            $request->input('type'),
            $request->input('issuer'),
            $request->input('name'),
            $request->input('amount_in_cents'),
            $request->input('due_day_of_month'),
            $request->input('notes'),
        );

        /**
         * Schedules future instances of this Expense
         * for the next 12 months
         */
        event(new ExpenseCreated($expense));

        return to_route('expenses.index');
    }

    /**
     * Expenses - Show Page.
     */
    public function show(Expense $expense): Response
    {
        Gate::authorize('isOwner', $expense);

        return inertia('Expenses/Show', [
            'expense' => $expense,
        ]);
    }

    /**
     * Updates an existing Expense.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
        Gate::authorize('isOwner', $expense);

        $amountChanged = $expense->amount_in_cents !== $request->input('amount_in_cents');
        $dueDayChanged = $expense->due_day_of_month !== $request->input('due_day_of_month');

        $expense = $expense->modify(
            $request->input('issuer'),
            $request->input('name'),
            $request->input('amount_in_cents'),
            $request->input('due_day_of_month'),
            $request->input('notes'),
        );

        /**
         * If ONLY amount value changed, modify all
         * future instances of this Expense
         */
        if ($amountChanged && ! $dueDayChanged) {
            event(new ExpenseModified($expense));
        }

        /**
         * If the recurrence changed, un-schedule
         * and reschedule all future instances of this Expense
         */
        if ($dueDayChanged) {
            event(new ExpenseRescheduled($expense));
        }

        return to_route('expenses.show', $expense);
    }

    /**
     * Removes an existing Expense.
     */
    public function destroy(Expense $expense): RedirectResponse
    {
        Gate::authorize('isOwner', $expense);

        $expense->remove();

        return to_route('expenses.index');
    }

    /**
     * Schedules an existing Expense.
     */
    public function schedule(Request $request, Expense $expense): RedirectResponse
    {
        Gate::authorize('isOwner', $expense);

        $request->validate([
            'due_date' => ['required', 'date'],
        ]);

        $expense->schedule(
            Carbon::parse($request->input('due_date')),
            $expense->amount_in_cents
        );

        return to_route('expenses.index');
    }
}
