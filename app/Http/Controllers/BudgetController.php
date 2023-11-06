<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Http\Resources\BudgetResource;
use App\Models\Budget;
use App\Services\BudgetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BudgetController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return BudgetResource::collection(
            Budget::where(
                'user_id',
                auth()->user()->id
            )->get()
        );
    }

    public function store(StoreBudgetRequest $request): BudgetResource
    {
        $budget = (new BudgetService())
            ->createBudget(
                auth()->user()->id,
                $request->name,
                $request->amount,
                $request->notes
            );

        return new BudgetResource($budget);
    }

    public function show(Budget $budget): BudgetResource
    {
        $this->authorize('user', $budget);

        return new BudgetResource($budget);
    }

    public function update(UpdateBudgetRequest $request, Budget $budget): BudgetResource
    {
        $this->authorize('user', $budget);

        $budget = (new BudgetService())
            ->updateBudget(
                $budget,
                $request->name,
                $request->amount,
                $request->notes
            );

        return new BudgetResource($budget);
    }

    public function destroy(Budget $budget): JsonResponse
    {
        $this->authorize('user', $budget);

        (new BudgetService())->deleteBudget($budget);

        return response()->json('', 204);
    }
}
