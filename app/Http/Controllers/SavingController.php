<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSavingRequest;
use App\Http\Requests\UpdateSavingRequest;
use App\Http\Resources\SavingResource;
use App\Models\PayPeriod;
use App\Models\Saving;
use App\Services\SavingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SavingController extends Controller
{
    public function __construct(protected SavingService $savingService)
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

    public function store(StoreSavingRequest $request, PayPeriod $payPeriod): SavingResource
    {
        $saving = $this->savingService->createSaving(
            Auth::user(),
            $payPeriod,
            $request->name,
            $request->amount
        );

        return new SavingResource($saving);
    }

    public function show(Saving $saving): Response
    {
        //
    }

    public function edit(Saving $saving): Response
    {
        //
    }

    public function update(UpdateSavingRequest $request, PayPeriod $payPeriod, Saving $saving): SavingResource
    {
        $this->authorize('update', $saving);

        $saving = $this->savingService->updateSaving(
            $saving,
            $request->name,
            $request->amount
        );

        return new SavingResource($saving);
    }

    public function destroy(Saving $saving): JsonResponse
    {
        $this->savingService->deleteSaving($saving);

        return response()->json('', 204);
    }
}
