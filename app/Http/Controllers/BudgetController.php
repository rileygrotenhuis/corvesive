<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Http\Resources\BudgetResource;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Services\BudgetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function __construct(protected BudgetService $budgetService)
    {
    }

    public function index(): Response
    {
        //
    }

    public function create(): Response
    {
        //
    }

    public function store(StoreBudgetRequest $request, PayPeriod $payPeriod): BudgetResource
    {
        $budget = $this->budgetService->createBudget(
            Auth::user(),
            $payPeriod,
            $request->name,
            $request->amount
        );

        return new BudgetResource($budget);
    }

    public function show(Budget $budget): Response
    {
        //
    }

    public function edit(Budget $budget): Response
    {
        //
    }

    public function update(UpdateBudgetRequest $request, PayPeriod $payPeriod, Budget $budget): BudgetResource
    {
        $this->authorize('update', $budget);

        $budget = $this->budgetService->updateBudget(
            $budget,
            $request->name,
            $request->amount
        );
    }

    public function destroy(PayPeriod $payPeriod, Budget $budget): JsonResponse
    {
        $this->authorize('delete', $budget);

        $this->budgetService->deleteBudget($budget);

        return response()->json('', 204);
    }
}
