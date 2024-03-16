<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonthlyBudgetRequest;
use App\Http\Requests\UpdateMonthlyBudgetRequest;
use App\Models\MonthlyBudget;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MonthlyBudgetController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Monthly/Budgets/Index', [
            'monthlyBudgets' => $request->user()->monthlyBudgets,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Monthly/Budgets/Create');
    }

    public function store(StoreMonthlyBudgetRequest $request): RedirectResponse
    {
        $request->user()->monthlyBudgets()->create([
            'name' => $request->input('name'),
            'total_balance_in_cents' => $request->input('total_balance') * 100,
            'notes' => $request->input('notes'),
        ]);

        return to_route('monthly.budgets.index');
    }

    public function show(MonthlyBudget $monthlyBudget): Response
    {
        $this->authorize('isOwner', $monthlyBudget);

        return Inertia::render('Monthly/Budgets/Show', [
            'monthlyBudget' => $monthlyBudget,
        ]);
    }

    public function update(UpdateMonthlyBudgetRequest $request, MonthlyBudget $monthlyBudget): RedirectResponse
    {
        $this->authorize('isOwner', $monthlyBudget);

        $monthlyBudget->update([
            'name' => $request->input('name'),
            'total_balance_in_cents' => $request->input('total_balance') * 100,
            'notes' => $request->input('notes'),
        ]);

        return to_route('monthly.budgets.show', $monthlyBudget);
    }

    public function destroy(): RedirectResponse
    {
        //
    }
}
