<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Http\Resources\BillResource;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class BillController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Bills/Index', [
            'bills' => BillResource::collection(
                Bill::where('user_id', Auth::user()->id)
                    ->orderBy('is_payed', 'desc')
                    ->get()
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Bills/Create');
    }

    public function store(StoreBillRequest $request): RedirectResponse
    {
        $bill = new Bill();
        $bill->user_id = Auth::user()->id;
        $bill->name = $request->name;
        $bill->amount = $request->amount * 100;
        $bill->save();

        return to_route('home');
    }

    public function show(Bill $bill): Response
    {
        $this->authorize('view', $bill);

        return Inertia::render('Bills/Show', [
            'bill' => new BillResource($bill),
        ]);
    }

    public function edit(Bill $bill): Response
    {
        $this->authorize('update', $bill);

        return Inertia::render('Bills/Edit', [
            'bill' => new BillResource($bill),
        ]);
    }

    public function update(UpdateBillRequest $request, Bill $bill): RedirectResponse
    {
        $this->authorize('update', $bill);

        $bill->name = $request->name;
        $bill->amount = $request->amount * 100;
        $bill->save();

        return to_route('home');
    }

    public function destroy(Bill $bill): RedirectResponse
    {
        $this->authorize('delete', $bill);

        $bill->delete();

        return to_route('home');
    }

    public function payment(Bill $bill): RedirectResponse
    {
        $bill->is_payed = true;
        $bill->save();

        $user = User::where('id', Auth::user()->id)->first();
        $user->total = $user->total - $bill->amount;
        $user->save();

        return to_route('home');
    }

    public function unpayment(Bill $bill): RedirectResponse
    {
        $bill->is_payed = false;
        $bill->save();

        $user = User::where('id', Auth::user()->id)->first();
        $user->total = $user->total + $bill->amount;
        $user->save();

        return to_route('home');
    }
}
