<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodRequest;
use App\Http\Requests\UpdatePayPeriodRequest;
use App\Http\Resources\PayPeriodResource;
use App\Models\PayPeriod;
use App\Services\PayPeriodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PayPeriodController extends Controller
{
    public function __construct(protected PayPeriodService $payPeriodService)
    {
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StorePayPeriodRequest $request): PayPeriodResource
    {
        $payPeriod = $this->payPeriodService->createPayPeriod(
            Auth::user(),
            $request->start_date,
            $request->end_date,
            $request->total_balance
        );

        return new PayPeriodResource($payPeriod);
    }

    public function show(PayPeriod $payPeriod)
    {
        //
    }

    public function edit(PayPeriod $payPeriod)
    {
        //
    }

    public function update(UpdatePayPeriodRequest $request, PayPeriod $payPeriod): PayPeriodResource
    {
        $this->authorize('update', $payPeriod);

        $payPeriod = $this->payPeriodService->updatePayPeriod(
            $payPeriod,
            $request->start_date,
            $request->end_date,
            $request->total_balance
        );

        return new PayPeriodResource($payPeriod);
    }

    public function destroy(PayPeriod $payPeriod): JsonResponse
    {
        $this->authorize('delete', $payPeriod);

        $this->payPeriodService->deletePayPeriod($payPeriod);

        return response()->json('', 204);
    }
}
