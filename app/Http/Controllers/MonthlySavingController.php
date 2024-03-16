<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonthlySavingRequest;
use App\Http\Requests\UpdateMonthlySavingRequest;
use App\Models\MonthlySaving;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MonthlySavingController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Monthly/Savings/Index', [
            'monthlySavings' => $request->user()->monthlySavings,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Monthly/Savings/Create');
    }

    public function store(StoreMonthlySavingRequest $request): RedirectResponse
    {
        $request->user()->monthlySavings()->create([
            'name' => $request->input('name'),
            'amount_in_cents' => $request->input('amount') * 100,
            'notes' => $request->input('notes'),
        ]);

        return to_route('monthly.savings.index');
    }

    public function show(MonthlySaving $monthlySaving): Response
    {
        $this->authorize('isOwner', $monthlySaving);

        return Inertia::render('Monthly/Savings/Show', [
            'monthlySaving' => $monthlySaving,
        ]);
    }

    public function update(UpdateMonthlySavingRequest $request, MonthlySaving $monthlySaving): RedirectResponse
    {
        $this->authorize('isOwner', $monthlySaving);

        $monthlySaving->update([
            'name' => $request->input('name'),
            'amount_in_cents' => $request->input('amount') * 100,
            'notes' => $request->input('notes'),
        ]);

        return to_route('monthly.savings.show', $monthlySaving);
    }

    public function destroy(): RedirectResponse
    {
        //
    }
}
