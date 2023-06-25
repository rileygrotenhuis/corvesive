<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentBudgetRequest;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Carbon\Carbon;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Budgets/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBudgetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBudgetRequest $request)
    {
        $budget = new Budget();
        $budget->user_id = Auth::user()->id;
        $budget->name = $request->name;
        $budget->amount = $request->amount * 100;
        $budget->show_daily_amount = $request->show_daily_amount;
        $budget->save();

        return to_route('budgets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        $this->authorize('view', $budget);

        return Inertia::render('Budgets/Show', [
            'budget' => [
                'id' => $budget->id,
                'name' => $budget->name,
                'amount' => $budget->amount,
                'show_daily_amount' => $budget->show_daily_amount,
                'average_daily_amount' => $budget->amount / (Carbon::now()->diffInDays(Carbon::parse(Auth::user()->next_payday))),
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget);

        return Inertia::render('Budgets/Edit', [
            'budget' => $budget
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBudgetRequest  $request
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBudgetRequest $request, Budget $budget)
    {
        $this->authorize('update', $budget);

        $budget->name = $request->name;
        $budget->amount = $request->amount * 100;
        $budget->show_daily_amount = $request->show_daily_amount;
        $budget->save();

        return to_route('budgets.show', $budget->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);

        $budget->delete();

        return to_route('budgets.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PaymentBudgetRequest  $request
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function payment(PaymentBudgetRequest $request, Budget $budget)
    {
        $budget->amount = $budget->amount - ($request->amount * 100);
        $budget->save();

        $request->user()->total = $request->user()->total - ($request->amount * 100);
        $request->user()->save();

        return to_route('budgets.show', $budget->id);
    }
}
