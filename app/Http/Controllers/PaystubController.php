<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaystubRequest;
use App\Http\Requests\UpdatePaystubRequest;
use App\Models\Paystub;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PaystubController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Paystubs/Index', [
            'paystubs' => $request->user()->paystubs,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Paystubs/Create');
    }

    public function store(StorePaystubRequest $request): RedirectResponse
    {
        foreach ($request->input('issued_days_of_month') as $day) {
            $request->user()->paystubs()->create([
                'issuer' => $request->input('issuer'),
                'amount_in_cents' => $request->input('amount') * 100,
                'issued_day_of_month' => $day,
                'notes' => $request->input('notes'),
            ]);
        }

        return to_route('paystubs.index');
    }

    public function show(Paystub $paystub): Response
    {
        $this->authorize('isOwner', $paystub);

        return Inertia::render('Paystubs/Show', [
            'paystub' => $paystub,
        ]);
    }

    public function update(UpdatePaystubRequest $request, Paystub $paystub): RedirectResponse
    {
        $this->authorize('isOwner', $paystub);

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
