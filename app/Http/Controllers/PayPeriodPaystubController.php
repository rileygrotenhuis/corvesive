<?php

namespace App\Http\Controllers;

use App\Http\Resources\PayPeriodResource;
use App\Models\PayPeriod;
use App\Models\Paystub;
use App\Services\PayPeriodPaystubService;
use Illuminate\Http\Request;

class PayPeriodPaystubController extends Controller
{
    public function store(Request $request, PayPeriod $payPeriod, Paystub $paystub): PayPeriodResource
    {
        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $this->authorize('paystub', [
            $payPeriod,
            $paystub,
        ]);

        (new PayPeriodPaystubService())
            ->addPaystubToPayPeriod(
                $payPeriod,
                $paystub,
                $request->amount
            );

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }

    public function update(Request $request, PayPeriod $payPeriod, Paystub $paystub): PayPeriodResource
    {
        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $this->authorize('paystub', [
            $payPeriod,
            $paystub,
        ]);

        (new PayPeriodPaystubService())
            ->updatePayPeriodPaystub(
                $payPeriod,
                $paystub,
                $request->amount
            );

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }

    public function destroy(PayPeriod $payPeriod, Paystub $paystub): PayPeriodResource
    {
        $this->authorize('paystub', [
            $payPeriod,
            $paystub,
        ]);

        (new PayPeriodPaystubService())
            ->removePaystubFromPayPeriod(
                $payPeriod,
                $paystub
            );

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }
}
