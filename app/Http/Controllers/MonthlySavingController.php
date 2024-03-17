<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonthlySavingRequest;
use App\Http\Requests\UpdateMonthlySavingRequest;
use App\Models\MonthlySaving;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class MonthlySavingController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Expenses/Savings/Index', [
            'monthlySavings' => $request->user()->monthlySavings,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Expenses/Savings/Create');
    }

    public function store(StoreMonthlySavingRequest $request): RedirectResponse
    {
        $request->user()->monthlySavings()->create([
            'name' => $request->input('name'),
            'amount_in_cents' => $request->input('amount') * 100,
            'notes' => $request->input('notes'),
        ]);

        return to_route('savings.index');
    }

    public function show(MonthlySaving $monthlySaving): Response
    {
        Gate::authorize('isOwner', $monthlySaving);

        return Inertia::render('Expenses/Savings/Show', [
            'monthlySaving' => $monthlySaving,
        ]);
    }

    public function update(UpdateMonthlySavingRequest $request, MonthlySaving $monthlySaving): RedirectResponse
    {
        Gate::authorize('isOwner', $monthlySaving);

        $monthlySaving->update([
            'name' => $request->input('name'),
            'amount_in_cents' => $request->input('amount') * 100,
            'notes' => $request->input('notes'),
        ]);

        return to_route('savings.show', $monthlySaving);
    }

    public function destroy(): RedirectResponse
    {
        //
    }
}
