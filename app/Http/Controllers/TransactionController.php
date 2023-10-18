<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function billTransaction(PayPeriod $payPeriod, PayPeriodBill $payPeriodBill): TransactionResource
    {
        return new TransactionResource([]);
    }

    public function budgetTransaction(Request $request, PayPeriod $payPeriod, PayPeriodBudget $payPeriodBudget): TransactionResource
    {
        $request->validate([
            'amount' => 'required|integer',
        ]);

        return new TransactionResource([]);
    }
}
