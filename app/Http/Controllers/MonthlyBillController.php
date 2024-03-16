<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonthlyBillRequest;
use App\Http\Requests\UpdateMonthlyBillRequest;
use App\Models\MonthlyBill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class MonthlyBillController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::Render('Expenses/Bills/Index', [
            'monthlyBills' => $request->user()->monthlyBills,
        ]);
    }

    public function create(): Response
    {
        return Inertia::Render('Expenses/Bills/Create');
    }

    public function store(StoreMonthlyBillRequest $request): RedirectResponse
    {
        $request->user()->monthlyBills()->create([
            'issuer' => $request->input('issuer'),
            'name' => $request->input('name'),
            'amount_in_cents' => $request->input('amount') * 100,
            'due_day_of_month' => $request->input('due_day_of_month'),
            'notes' => $request->input('notes'),
        ]);

        return to_route('bills.index');
    }

    public function show(MonthlyBill $monthlyBill): Response
    {
        Gate::authorize('isOwner', $monthlyBill);

        return Inertia::Render('Expenses/Bills/Show', [
            'monthlyBill' => $monthlyBill,
        ]);
    }

    public function update(UpdateMonthlyBillRequest $request, MonthlyBill $monthlyBill): RedirectResponse
    {
        Gate::authorize('isOwner', $monthlyBill);

        $monthlyBill->update([
            'issuer' => $request->input('issuer'),
            'name' => $request->input('name'),
            'amount_in_cents' => $request->input('amount') * 100,
            'due_day_of_month' => $request->input('due_day_of_month'),
            'notes' => $request->input('notes'),
        ]);

        return to_route('bills.show', $monthlyBill);
    }

    public function destroy(): RedirectResponse
    {
        //
    }
}
