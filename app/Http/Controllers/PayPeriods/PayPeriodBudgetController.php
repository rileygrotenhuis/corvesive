<?php

namespace App\Http\Controllers\PayPeriods;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayPeriods\UpdatePayPeriodBudgetRequest;
use App\Http\Resources\PayPeriods\PayPeriodResource;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Services\PayPeriods\PayPeriodBudgetService;
use Illuminate\Http\Request;

class PayPeriodBudgetController extends Controller
{
    public function store(Request $request, PayPeriod $payPeriod, Budget $budget): PayPeriodResource
    {
        $request->validate([
            'total_balance' => 'required|integer|min:0',
        ]);

        $this->authorize('budget', [
            $payPeriod,
            $budget,
        ]);

        (new PayPeriodBudgetService())
            ->addBudgetToPayPeriod(
                $payPeriod->id,
                $budget->id,
                $request->total_balance,
            );

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }

    public function update(UpdatePayPeriodBudgetRequest $request, PayPeriod $payPeriod, Budget $budget): PayPeriodResource
    {
        $this->authorize('budget', [
            $payPeriod,
            $budget,
        ]);

        (new PayPeriodBudgetService())
            ->updatePayPeriodBudget(
                $payPeriod->id,
                $budget->id,
                $request->total_balance,
                $request->remaining_balance
            );

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }

    public function destroy(PayPeriod $payPeriod, Budget $budget): PayPeriodResource
    {
        $this->authorize('budget', [
            $payPeriod,
            $budget,
        ]);

        (new PayPeriodBudgetService())
            ->removeBudgetFromPayPeriod(
                $payPeriod,
                $budget
            );

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }
}
