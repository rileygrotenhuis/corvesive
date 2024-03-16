<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepositRequest;
use App\Http\Requests\UpdateDepositRequest;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class DepositController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::Render('Income/Deposits/Index', [
            'deposits' => $request->user()->deposits()->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::Render('Income/Deposits/Create');
    }

    public function store(StoreDepositRequest $request)
    {
        $request->user()->deposits()->create([
            'amount_in_cents' => $request->input('amount') * 100,
            'notes' => $request->input('notes'),
        ]);

        return to_route('deposits.index');
    }

    public function update(UpdateDepositRequest $request, Deposit $deposit)
    {
        Gate::authorize('isOwner', $deposit);

        $deposit->update([
            'amount_in_cents' => $request->input('amount') * 100,
            'notes' => $request->input('notes'),
        ]);

        return to_route('deposits.show', $deposit);
    }

    public function destroy(Deposit $deposit)
    {
        //
    }
}
