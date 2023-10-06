<?php

namespace App\Http\Controllers;

use App\Http\Queries\CreditAccountQuery;
use App\Http\Requests\StoreCreditAccountRequest;
use App\Http\Requests\UpdateCreditAccountRequest;
use App\Http\Resources\CreditAccountResource;
use App\Models\CreditAccount;
use App\Services\CreditAccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CreditAccountController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CreditAccountResource::collection(
            (new CreditAccountQuery())
                ->where('user_id', auth()->user()->id)
                ->paginate(100)
        );
    }

    public function store(StoreCreditAccountRequest $request): CreditAccountResource
    {
        $creditAccount = (new CreditAccountService())
            ->createCreditAccount(
                auth()->user()->id,
                $request->issuer,
                $request->name,
                $request->type,
                $request->credit_limit,
                $request->interest_rate,
                $request->annual_fee,
                $request->benefits,
                $request->notes
            );

        return new CreditAccountResource($creditAccount);
    }

    public function show(CreditAccount $creditAccount): CreditAccountResource
    {
        $this->authorize('show', $creditAccount);

        return new CreditAccountResource($creditAccount);
    }

    public function update(UpdateCreditAccountRequest $request, CreditAccount $creditAccount): CreditAccountResource
    {
        $this->authorize('update', $creditAccount);

        $creditAccount = (new CreditAccountService())
            ->updateCreditAccount(
                $creditAccount,
                $request->issuer,
                $request->name,
                $request->type,
                $request->credit_limit,
                $request->interest_rate,
                $request->annual_fee,
                $request->benefits,
                $request->notes
            );

        return new CreditAccountResource($creditAccount);
    }

    public function destroy(CreditAccount $creditAccount): JsonResponse
    {
        $this->authorize('destroy', $creditAccount);

        (new CreditAccountService())->deleteCreditAccount($creditAccount);

        return response()->json('', 204);
    }
}
