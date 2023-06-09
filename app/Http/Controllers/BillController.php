<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Http\Resources\BillResource;
use App\Models\Bill;
use App\Models\PayPeriod;
use App\Services\BillService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function __construct(protected BillService $billService)
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

    public function store(StoreBillRequest $request, PayPeriod $payPeriod): BillResource
    {
        $bill = $this->billService->createBill(
            Auth::user(),
            $payPeriod,
            $request->name,
            $request->amount
        );

        return new BillResource($bill);
    }

    public function show(Bill $bill)
    {
        //
    }

    public function edit(Bill $bill)
    {
        //
    }

    public function update(UpdateBillRequest $request, PayPeriod $payPeriod, Bill $bill): BillResource
    {
        $this->authorize('update', $bill);

        $bill = $this->billService->updateBill(
            $bill,
            $request->name,
            $request->amount,
        );

        return new BillResource($bill);
    }

    public function destroy(PayPeriod $payPeriod, Bill $bill): JsonResponse
    {
        $this->authorize('delete', $bill);

        $this->billService->deleteBill($bill);

        return response()->json('', 204);
    }
}
