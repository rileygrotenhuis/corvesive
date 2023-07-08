<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use Illuminate\Http\Response;

class BillController extends Controller
{
    public function index(): Response
    {
        //
    }

    public function create(): Response
    {
        //
    }

    public function store(StoreBillRequest $request): Response
    {
        //
    }

    public function show(Bill $Bill): Response
    {
        //
    }

    public function edit(Bill $Bill): Response
    {
        //
    }

    public function update(UpdateBillRequest $request, Bill $Bill): Response
    {
        //
    }

    public function destroy(Bill $Bill): Response
    {
        //
    }
}
