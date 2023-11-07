<?php

namespace App\Http\Controllers\PayPeriods;

use App\Exceptions\AlreadyAttachedToPayPeriod;
use App\Http\Controllers\Controller;
use App\Http\Requests\PayPeriods\UpdatePayPeriodBudgetRequest;
use App\Http\Resources\PayPeriods\PayPeriodBudgetResource;
use App\Http\Resources\PayPeriods\PayPeriodResource;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\PayPeriodBudget;
use App\Services\PayPeriods\PayPeriodBudgetService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PayPeriodBudgetController extends Controller
{
    public function __construct(protected PayPeriodBudgetService $payPeriodBudgetService)
    {
    }

    public function index(PayPeriod $payPeriod): AnonymousResourceCollection
    {
        return PayPeriodBudgetResource::collection(
            PayPeriodBudget::with('budget')
                ->where('pay_period_id', $payPeriod->id)
                ->orderBy('pay_period_budget.remaining_balance', 'desc')
                ->get()
        );
    }

    public function store(Request $request, PayPeriod $payPeriod, Budget $budget): PayPeriodResource
    {
        $request->validate([
            'total_balance' => 'required|integer|min:0',
        ]);

        $this->authorize('budget', [
            $payPeriod,
            $budget,
        ]);

        if ($this->payPeriodBudgetService->budgetIsAlreadyAttachedToPayPeriod($payPeriod, $budget)) {
            throw new AlreadyAttachedToPayPeriod();
        }

        $this->payPeriodBudgetService
            ->addBudgetToPayPeriod(
                $payPeriod->id,
                $budget->id,
                $request->total_balance,
            );

        return new PayPeriodResource($payPeriod);
    }

    public function update(UpdatePayPeriodBudgetRequest $request, PayPeriod $payPeriod, Budget $budget): PayPeriodResource
    {
        $this->authorize('budget', [
            $payPeriod,
            $budget,
        ]);

        $this->payPeriodBudgetService
            ->updatePayPeriodBudget(
                $payPeriod->id,
                $budget->id,
                $request->total_balance,
                $request->remaining_balance
            );

        return new PayPeriodResource($payPeriod);
    }

    public function destroy(PayPeriod $payPeriod, Budget $budget): PayPeriodResource
    {
        $this->authorize('budget', [
            $payPeriod,
            $budget,
        ]);

        $this->payPeriodBudgetService
            ->removeBudgetFromPayPeriod(
                $payPeriod,
                $budget
            );

        return new PayPeriodResource($payPeriod);
    }
}
