<?php

namespace App\Http\Controllers;

use App\Http\Queries\SpendingQuery;
use App\Http\Requests\UpdateSpendingRequest;
use App\Http\Resources\SpendingResource;
use App\Models\PayPeriod;
use App\Models\Spending;
use App\Services\SpendingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SpendingController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return SpendingResource::collection(
            (new SpendingQuery())
                ->where('user_id', auth()->user()->id)
                ->paginate(100)
        );
    }

    public function store(Request $request, PayPeriod $payPeriod): SpendingResource
    {
        $request->validate([
            'total_balance' => 'required|integer|min:0',
        ]);

        $this->authorize('spending', $payPeriod);

        $spending = (new SpendingService())
            ->createSpending(
                auth()->user()->id,
                $payPeriod->id,
                $request->total_balance
            );

        return new SpendingResource($spending);
    }

    public function show(PayPeriod $payPeriod, Spending $spending): SpendingResource
    {
        $this->authorize('spending', $payPeriod);
        $this->authorize('show', $spending);

        return new SpendingResource($spending);
    }

    public function update(
        UpdateSpendingRequest $request,
        PayPeriod $payPeriod,
        Spending $spending
    ): SpendingResource {
        $this->authorize('spending', $payPeriod);
        $this->authorize('update', $spending);

        $spending = (new SpendingService())
            ->updateSpending(
                $spending,
                $request->total_balance,
                $request->remaining_balance
            );

        return new SpendingResource($spending);
    }

    public function destroy(PayPeriod $payPeriod, Spending $spending): JsonResponse
    {
        $this->authorize('spending', $payPeriod);
        $this->authorize('destroy', $spending);

        (new SpendingService())->deleteSpending($spending);

        return response()->json('', 204);
    }
}
