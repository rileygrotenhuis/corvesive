<?php

namespace App\Http\Controllers;

use App\Events\Expenses\ExpenseCreated;
use App\Events\Expenses\ExpenseModified;
use App\Events\Expenses\ExpenseRescheduled;
use App\Http\Requests\Expenses\StoreExpenseRequest;
use App\Http\Requests\Expenses\UpdateExpenseRequest;
use App\Models\Expense;
use App\Repositories\ExpenseRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Response;

class ExpenseController extends Controller
{
    public function index(Request $request): Response
    {
        $repository = new ExpenseRepository($request->user());

        return inertia('Expenses/Index', [
            'expenses' => [
                'all' => $repository->all(),
                'upcoming' => $repository->upcoming(),
                'thisMonth' => $repository->thisMonth(),
                'nextMonth' => $repository->nextMonth(),
            ],
        ]);
    }

    public function create(): Response
    {
        return inertia('Expenses/Create');
    }

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

    public function show(Expense $expense): Response
    {
        Gate::authorize('isOwner', $expense);

        return inertia('Expenses/Show', [
            'expense' => $expense,
        ]);
    }

    public function update(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
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
}
