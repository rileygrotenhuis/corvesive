<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Services\PayPeriodBreakdownService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function create(Request $request): Response
    {
        $service = new PayPeriodBreakdownService($request->user()->currentPayPeriod);

        return Inertia::render('Transactions/Create', [
            'bills' => $service->getBillsBreakdown(),
            'budgets' => $service->getBudgetsBreakdown(),
            'savings' => $service->getSavingsBreakdown(),
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
