<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSavingRequest;
use App\Http\Requests\UpdateSavingRequest;
use App\Http\Resources\SavingResource;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class SavingController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Savings/Index', [
            'savings' => SavingResource::collection(
                Saving::where('user_id', Auth::user()->id)
                    ->orderBy('is_payed', 'asc')
                    ->get()
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Savings/Create');
    }

    public function store(StoreSavingRequest $request): RedirectResponse
    {
        $saving = new Saving();
        $saving->user_id = Auth::user()->id;
        $saving->name = $request->name;
        $saving->amount = $request->amount * 100;
        $saving->save();

        return to_route('home');
    }

    public function show(Saving $saving): Response
    {
        $this->authorize('view', $saving);

        return Inertia::render('Savings/Show', [
            'saving' => new SavingResource($saving),
        ]);
    }

    public function edit(Saving $saving): Response
    {
        $this->authorize('update', $saving);

        return Inertia::render('Savings/Edit', [
            'saving' => new SavingResource($saving),
        ]);
    }

    public function update(UpdateSavingRequest $request, Saving $saving): RedirectResponse
    {
        $this->authorize('update', $saving);

        $saving->name = $request->name;
        $saving->amount = $request->amount * 100;
        $saving->save();

        return to_route('savings.show', $saving->id);
    }

    public function destroy(Saving $saving): RedirectResponse
    {
        $this->authorize('delete', $saving);

        $saving->delete();

        return to_route('home');
    }

    public function payment(Saving $saving): RedirectResponse
    {
        $saving->is_payed = true;
        $saving->save();

        $user = User::where('id', Auth::user()->id)->first();
        $user->total = $user->total - $saving->amount;
        $user->save();

        return to_route('home', $saving);
    }

    public function unpayment(Saving $saving): RedirectResponse
    {
        $saving->is_payed = false;
        $saving->save();

        $user = User::where('id', Auth::user()->id)->first();
        $user->total = $user->total + $saving->amount;
        $user->save();

        return to_route('home', $saving);
    }
}
