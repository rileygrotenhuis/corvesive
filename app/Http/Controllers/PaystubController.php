<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaystubRequest;
use App\Http\Requests\UpdatePaystubRequest;
use App\Models\Paystub;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class PaystubController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::Render('Income/Paystubs/Index', [
            'paystubs' => $request->user()->paystubs,
        ]);
    }

    public function create(): Response
    {
        return Inertia::Render('Income/Paystubs/Create');
    }

    public function store(StorePaystubRequest $request): RedirectResponse
    {
        $request->user()->paystubs()->create([
            'issuer' => $request->input('issuer'),
            'amount_in_cents' => $request->input('amount') * 100,
            'issued_day_of_month' => $request->input('issued_day_of_month'),
            'notes' => $request->input('notes'),
        ]);

        return to_route('paystubs.index');
    }

    public function show(Paystub $paystub): Response
    {
        Gate::authorize('isOwner', $paystub);

        return Inertia::Render('Income/Paystubs/Show', [
            'paystub' => $paystub,
        ]);
    }

    public function update(UpdatePaystubRequest $request, Paystub $paystub): RedirectResponse
    {
        Gate::authorize('isOwner', $paystub);

        $paystub->update([
            'issuer' => $request->input('issuer'),
            'amount_in_cents' => $request->input('amount') * 100,
            'issued_day_of_month' => $request->input('issued_day_of_month'),
            'notes' => $request->input('notes'),
        ]);

        return to_route('paystubs.show', $paystub);
    }

    public function destroy(): RedirectResponse
    {

    }
}
