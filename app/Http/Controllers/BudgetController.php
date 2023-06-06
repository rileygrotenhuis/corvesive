<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentBudgetRequest;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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
                ->get(),
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
        return Inertia::render('Budgets/Show', [
            'budget' => $budget
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
        $budget->name = $request->name;
        $budget->amount = $request->amount * 100;
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
        //
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

        return to_route('budgets.show', $budget->id);
    }
}
