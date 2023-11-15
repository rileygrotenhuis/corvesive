<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSavingRequest;
use App\Http\Requests\UpdateSavingRequest;
use App\Http\Resources\SavingResource;
use App\Models\Saving;
use App\Services\SavingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SavingController extends Controller
{
    public function __construct(protected SavingService $savingService)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return SavingResource::collection(
            Saving::where(
                'user_id',
                auth()->user()->id
            )->orderBy('amount', 'desc')->get()
        );
    }

    public function store(StoreSavingRequest $request): SavingResource
    {
        $saving = $this->savingService->createSaving(
            auth()->user()->id,
            $request->name,
            $request->amount,
            $request->notes
        );

        return new SavingResource($saving);
    }

    public function show(Saving $saving): SavingResource
    {
        $this->authorize('user', $saving);

        return new SavingResource($saving);
    }

    public function update(UpdateSavingRequest $request, Saving $saving): SavingResource
    {
        $this->authorize('user', $saving);

        $saving = $this->savingService->updateSaving(
            $saving,
            $request->name,
            $request->amount,
            $request->notes
        );

        return new SavingResource($saving);
    }

    public function destroy(Saving $saving): JsonResponse
    {
        $this->authorize('user', $saving);

        $this->savingService->deleteSaving($saving);

        return response()->json('', 204);
    }
}
