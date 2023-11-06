<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Http\Resources\BillResource;
use App\Models\Bill;
use App\Services\BillService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BillController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return BillResource::collection(
            Bill::where(
                'user_id',
                auth()->user()->id
            )->get()
        );
    }

    public function store(StoreBillRequest $request): BillResource
    {
        $bill = (new BillService())
            ->createBill(
                auth()->user()->id,
                $request->issuer,
                $request->name,
                $request->amount,
                $request->due_date,
                $request->notes,
            );

        return new BillResource($bill);
    }

    public function show(Bill $bill): BillResource
    {
        $this->authorize('user', $bill);

        return new BillResource($bill);
    }

    public function update(UpdateBillRequest $request, Bill $bill): BillResource
    {
        $this->authorize('user', $bill);

        $bill = (new BillService())
            ->updateBill(
                $bill,
                $request->issuer,
                $request->name,
                $request->amount,
                $request->due_date,
                $request->notes,
            );

        return new BillResource($bill);
    }

    public function destroy(Bill $bill): JsonResponse
    {
        $this->authorize('user', $bill);

        (new BillService())->deleteBill($bill);

        return response()->json('', 204);
    }
}
