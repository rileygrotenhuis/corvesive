<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentBudgetRequest;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Http\Resources\BudgetResource;
use App\Models\Budget;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class BudgetController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Budgets/Index', [
            'budgets' => BudgetResource::collection(
                Budget::where('user_id', Auth::user()->id)
                    ->get()
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Budgets/Create');
    }

    public function store(StoreBudgetRequest $request): RedirectResponse
    {
        $budget = new Budget();
        $budget->user_id = Auth::user()->id;
        $budget->name = $request->name;
        $budget->amount = $request->amount * 100;
        $budget->show_daily_amount = $request->show_daily_amount;
        $budget->save();

        return to_route('home');
    }

    public function show(Budget $budget): Response
    {
        $this->authorize('view', $budget);

        return Inertia::render('Budgets/Show', [
            'budget' => new BudgetResource($budget),
        ]);
    }

    public function edit(Budget $budget): Response
    {
        $this->authorize('update', $budget);

        return Inertia::render('Budgets/Edit', [
            'budget' => new BudgetResource($budget),
        ]);
    }

    public function update(UpdateBudgetRequest $request, Budget $budget): RedirectResponse
    {
        $this->authorize('update', $budget);

        $budget->name = $request->name;
        $budget->amount = $request->amount * 100;
        $budget->show_daily_amount = $request->show_daily_amount;
        $budget->save();

        return to_route('home');
    }

    public function destroy(Budget $budget): RedirectResponse
    {
        $this->authorize('delete', $budget);

        $budget->delete();

        return to_route('home');
    }

    public function payment(PaymentBudgetRequest $request, Budget $budget): RedirectResponse
    {
        $budget->amount = $budget->amount - ($request->amount * 100);
        $budget->save();

        $request->user()->total = $request->user()->total - ($request->amount * 100);
        $request->user()->save();

        return to_route('home');
    }
}
