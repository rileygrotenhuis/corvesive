<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentBudgetRequest;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class BudgetController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Budgets/Index', [
            'budgets' => Budget::with('user')
                ->where('user_id', Auth::user()->id)
                ->get()
                ->map(function ($budget) {
                    return [
                        'id' => $budget->id,
                        'name' => $budget->name,
                        'amount' => $budget->amount,
                        'show_daily_amount' => $budget->show_daily_amount,
                        'average_daily_amount' => $budget->amount / (Carbon::now()->diffInDays(Carbon::parse(Auth::user()->next_payday))),
                    ];
                }),
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

        return to_route('budgets.index');
    }

    public function show(Budget $budget): Response
    {
        $this->authorize('view', $budget);

        return Inertia::render('Budgets/Show', [
            'budget' => [
                'id' => $budget->id,
                'name' => $budget->name,
                'amount' => $budget->amount,
                'show_daily_amount' => $budget->show_daily_amount,
                'average_daily_amount' => $budget->amount / (Carbon::now()->diffInDays(Carbon::parse(Auth::user()->next_payday))),
            ],
        ]);
    }

    public function edit(Budget $budget): Response
    {
        $this->authorize('update', $budget);

        return Inertia::render('Budgets/Edit', [
            'budget' => $budget,
        ]);
    }

    public function update(UpdateBudgetRequest $request, Budget $budget): RedirectResponse
    {
        $this->authorize('update', $budget);

        $budget->name = $request->name;
        $budget->amount = $request->amount * 100;
        $budget->show_daily_amount = $request->show_daily_amount;
        $budget->save();

        return to_route('budgets.show', $budget->id);
    }

    public function destroy(Budget $budget): RedirectResponse
    {
        $this->authorize('delete', $budget);

        $budget->delete();

        return to_route('budgets.index');
    }

    public function payment(PaymentBudgetRequest $request, Budget $budget): RedirectResponse
    {
        $budget->amount = $budget->amount - ($request->amount * 100);
        $budget->save();

        $request->user()->total = $request->user()->total - ($request->amount * 100);
        $request->user()->save();

        return to_route('budgets.index');
    }
}
