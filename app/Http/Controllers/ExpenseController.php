<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ExpenseController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Expenses/Index', [
            'expenses' => Expense::with('user')
                ->where('user_id', Auth::user()->id)
                ->orderBy('is_payed', 'asc')
                ->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Expenses/Create');
    }

    public function store(StoreExpenseRequest $request): RedirectResponse
    {
        $expense = new Expense();
        $expense->user_id = Auth::user()->id;
        $expense->name = $request->name;
        $expense->amount = $request->amount * 100;
        $expense->save();

        return to_route('expenses.index');
    }

    public function show(Expense $expense): Response
    {
        $this->authorize('view', $expense);

        return Inertia::render('Expenses/Show', [
            'expense' => $expense,
        ]);
    }

    public function edit(Expense $expense): Response
    {
        $this->authorize('update', $expense);

        return Inertia::render('Expenses/Edit', [
            'expense' => $expense,
        ]);
    }

    public function update(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
        $this->authorize('update', $expense);

        $expense->name = $request->name;
        $expense->amount = $request->amount * 100;
        $expense->save();

        return to_route('expenses.show', $expense->id);
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        $this->authorize('delete', $expense);

        $expense->delete();

        return to_route('expenses.index');
    }

    public function payment(Expense $expense): RedirectResponse
    {
        $expense->is_payed = true;
        $expense->save();

        $user = User::where('id', Auth::user()->id)->first();
        $user->total = $user->total - $expense->amount;
        $user->save();

        return to_route('expenses.index', $expense);
    }

    public function unpayment(Expense $expense): RedirectResponse
    {
        $expense->is_payed = false;
        $expense->save();

        $user = User::where('id', Auth::user()->id)->first();
        $user->total = $user->total + $expense->amount;
        $user->save();

        return to_route('expenses.index', $expense);
    }
}
