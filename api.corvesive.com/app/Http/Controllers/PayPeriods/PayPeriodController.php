<?php

namespace App\Http\Controllers\PayPeriods;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayPeriods\StorePayPeriodRequest;
use App\Http\Requests\PayPeriods\UpdatePayPeriodRequest;
use App\Http\Resources\PayPeriods\PayPeriodResource;
use App\Models\PayPeriod;
use App\Services\PayPeriods\AutoGenerateResourceService;
use App\Services\PayPeriods\PayPeriodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PayPeriodController extends Controller
{
    public function __construct(protected PayPeriodService $payPeriodService)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return PayPeriodResource::collection(
            PayPeriod::where(
                'user_id',
                auth()->user()->id
            )->get()
        );
    }

    public function store(StorePayPeriodRequest $request): PayPeriodResource
    {
        $payPeriod = $this->payPeriodService
            ->createPayPeriod(
                auth()->user()->id,
                $request->start_date,
                $request->end_date
            );

        if ($request->auto_generate_resources) {
            resolve(AutoGenerateResourceService::class)->autoGenerateAllPayPeriodResources($payPeriod, auth()->user());
        }

        return new PayPeriodResource($payPeriod);
    }

    public function show(PayPeriod $payPeriod): PayPeriodResource
    {
        $this->authorize('user', $payPeriod);

        return new PayPeriodResource($payPeriod);
    }

    public function update(UpdatePayPeriodRequest $request, PayPeriod $payPeriod): PayPeriodResource
    {
        $this->authorize('user', $payPeriod);

        $payPeriod = $this->payPeriodService
            ->updatePayPeriod(
                $payPeriod,
                $request->start_date,
                $request->end_date
            );

        $payPeriod->save();

        return new PayPeriodResource($payPeriod);
    }

    public function destroy(PayPeriod $payPeriod): JsonResponse
    {
        $this->authorize('user', $payPeriod);

        $this->payPeriodService->deletePayPeriod($payPeriod);

        return response()->json('', 204);
    }

    public function complete(PayPeriod $payPeriod): JsonResponse
    {
        $this->authorize('user', $payPeriod);

        return response()->json('', 204);
    }
}
