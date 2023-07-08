<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodRequest;
use App\Http\Requests\UpdatePayPeriodRequest;
use App\Models\PayPeriod;
use Illuminate\Http\Response;

class PayPeriodController extends Controller
{
    public function index(): Response
    {
        //
    }

    public function create(): Response
    {
        //
    }

    public function store(StorePayPeriodRequest $request): Response
    {
        //
    }

    public function show(PayPeriod $payPeriod): Response
    {
        //
    }

    public function edit(PayPeriod $payPeriod): Response
    {
        //
    }

    public function update(UpdatePayPeriodRequest $request, PayPeriod $payPeriod): Response
    {
        //
    }

    public function destroy(PayPeriod $payPeriod): Response
    {
        //
    }
}
