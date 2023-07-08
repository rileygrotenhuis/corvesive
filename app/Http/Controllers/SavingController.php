<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSavingRequest;
use App\Http\Requests\UpdateSavingRequest;
use App\Models\Saving;
use Illuminate\Http\Response;

class SavingController extends Controller
{
    public function index(): Response
    {
        //
    }

    public function create(): Response
    {
        //
    }

    public function store(StoreSavingRequest $request): Response
    {
        //
    }

    public function show(Saving $Saving): Response
    {
        //
    }

    public function edit(Saving $Saving): Response
    {
        //
    }

    public function update(UpdateSavingRequest $request, Saving $Saving): Response
    {
        //
    }

    public function destroy(Saving $Saving): Response
    {
        //
    }
}
