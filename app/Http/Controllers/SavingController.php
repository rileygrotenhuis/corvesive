<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSavingRequest;
use App\Http\Requests\UpdateSavingRequest;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Savings/Index', [
            'savings' => Saving::with('user')
                ->where('user_id', Auth::user()->id)
                ->orderBy('is_payed', 'asc')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Savings/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSavingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSavingRequest $request)
    {
        $saving = new Saving();
        $saving->user_id = Auth::user()->id;
        $saving->name = $request->name;
        $saving->amount = $request->amount * 100;
        $saving->save();

        return to_route('savings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function show(Saving $saving)
    {
        $this->authorize('view', $saving);

        return Inertia::render('Savings/Show', [
            'saving' => $saving
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function edit(Saving $saving)
    {
        $this->authorize('update', $saving);

        return Inertia::render('Savings/Edit', [
            'saving' => $saving
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSavingRequest  $request
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSavingRequest $request, Saving $saving)
    {
        $this->authorize('update', $saving);

        $saving->name = $request->name;
        $saving->amount = $request->amount * 100;
        $saving->save();

        return to_route('savings.show', $saving->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saving $saving)
    {
        $this->authorize('delete', $saving);

        $saving->delete();

        return to_route('savings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function payment(Saving $saving)
    {
        $saving->is_payed = true;
        $saving->save();

        $user = User::where('id', Auth::user()->id)->first();
        $user->total = $user->total - $saving->amount;
        $user->save();

        return to_route('savings.index', $saving);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function unpayment(Saving $saving)
    {
        $saving->is_payed = false;
        $saving->save();

        $user = User::where('id', Auth::user()->id)->first();
        $user->total = $user->total + $saving->amount;
        $user->save();

        return to_route('savings.index', $saving);
    }
}
