<?php

namespace App\Http\Controllers;

use App\Http\Queries\PayPeriodQuery;
use App\Http\Requests\StorePayPeriodRequest;
use App\Http\Requests\UpdatePayPeriodRequest;
use App\Http\Resources\PayPeriodResource;
use App\Models\PayPeriod;
use App\Services\PayPeriodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PayPeriodController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PayPeriodResource::collection(
            (new PayPeriodQuery())
                ->where('user_id', auth()->user()->id)
                ->paginate(100)
        );
    }

    public function store(StorePayPeriodRequest $request): PayPeriodResource
    {
        $payPeriod = (new PayPeriodService())
            ->createPayPeriod(
                auth()->user()->id,
                $request->start_date,
                $request->end_date
            );

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }

    public function show(PayPeriod $payPeriod): PayPeriodResource
    {
        $this->authorize('show', $payPeriod);

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }

    public function update(UpdatePayPeriodRequest $request, PayPeriod $payPeriod): PayPeriodResource
    {
        $this->authorize('update', $payPeriod);

        $payPeriod = (new PayPeriodService())
            ->updatePayPeriod(
                $payPeriod,
                $request->start_date,
                $request->end_date,
                $request->total_balance
            );

        $payPeriod->save();

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }

    public function destroy(PayPeriod $payPeriod): JsonResponse
    {
        $this->authorize('destroy', $payPeriod);

        (new PayPeriodService())->deletePayPeriod($payPeriod);

        return response()->json('', 204);
    }
}
