<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\PayPeriodBreakdownService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function index(Request $request): Response
    {
        $currentPayPeriod = $request->user()->currentPayPeriod;

        $transactions = Transaction::query()
            ->where('created_at', '>=', $currentPayPeriod->start_date)
            ->where('created_at', '<=', $currentPayPeriod->end_date)
            ->get();

        return Inertia::render('Transactions/Index', [
            'transactions' => $transactions,
        ]);
    }

    public function create(Request $request): Response
    {
        $service = new PayPeriodBreakdownService($request->user()->currentPayPeriod);

        return Inertia::render('Transactions/Create', [
            'bills' => $service->getBillsBreakdown(),
            'budgets' => $service->getBudgetsBreakdown(),
            'savings' => $service->getSavingsBreakdown(),
        ]);
    }
}
