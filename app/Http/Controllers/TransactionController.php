<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillTransactionRequest;
use App\Http\Requests\StoreBudgetTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;

class TransactionController extends Controller
{
    public function billTransaction(StoreBillTransactionRequest $request, PayPeriod $payPeriod, PayPeriodBill $payPeriodBill): TransactionResource
    {
        return new TransactionResource([]);
    }

    public function budgetTransaction(StoreBudgetTransactionRequest $request, PayPeriod $payPeriod, PayPeriodBudget $payPeriodBudget): TransactionResource
    {
        return new TransactionResource([]);
    }
}
