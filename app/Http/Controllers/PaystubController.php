<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaystubRequest;
use App\Http\Requests\UpdatePaystubRequest;
use App\Http\Resources\PaystubResource;
use App\Models\Paystub;
use App\Services\PaystubService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaystubController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PaystubResource::collection(
            Paystub::where(
                'user_id',
                auth()->user()->id
            )->get()
        );
    }

    public function store(StorePaystubRequest $request): PaystubResource
    {
        $paystub = (new PaystubService())
            ->createPaystub(
                auth()->user()->id,
                $request->issuer,
                $request->amount,
                $request->notes,
            );

        return new PaystubResource($paystub);
    }

    public function show(Paystub $paystub): PaystubResource
    {
        $this->authorize('user', $paystub);

        return new PaystubResource($paystub);
    }

    public function update(UpdatePaystubRequest $request, Paystub $paystub): PaystubResource
    {
        $this->authorize('user', $paystub);

        $paystub = (new PaystubService())
            ->updatePaystub(
                $paystub,
                $request->issuer,
                $request->amount,
                $request->notes,
            );

        return new PaystubResource($paystub);
    }

    public function destroy(Paystub $paystub): JsonResponse
    {
        $this->authorize('user', $paystub);

        (new PaystubService())->deletePaystub($paystub);

        return response()->json('', 204);
    }
}
