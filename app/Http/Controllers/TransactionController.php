<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\PayPeriodSaving;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function create(Request $request): Response
    {
        $currentPayPeriod = $request->user()->currentPayPeriod;

        $bills = PayPeriodBill::query()
            ->with('bill')
            ->where('pay_period_id', $currentPayPeriod->id)
            ->get();

        $budgets = PayPeriodBudget::query()
            ->with('budget')
            ->where('pay_period_id', $currentPayPeriod->id)
            ->get();

        $savings = PayPeriodSaving::query()
            ->with('monthlySaving')
            ->where('pay_period_id', $currentPayPeriod->id)
            ->get();

        return Inertia::render('Transactions/Create', [
            'bills' => $bills,
            'budgets' => $budgets,
            'savings' => $savings,
        ]);
    }

    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        $request->user()->transactions()->create([
            'transactionable_type' => $request->input('transactionable_type'),
            'transactionable_id' => $request->input('transactionable_id'),
            'amount_in_cents' => $request->input('amount') * 100,
        ]);

        return to_route('pay-periods.index');
    }
}
