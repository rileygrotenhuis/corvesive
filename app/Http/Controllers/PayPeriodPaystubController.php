<?php

namespace App\Http\Controllers;

use App\Http\Resources\PayPeriodResource;
use App\Models\PayPeriod;
use App\Models\Paystub;
use App\Services\PayPeriodPaystubService;

class PayPeriodPaystubController extends Controller
{
    public function store(PayPeriod $payPeriod, Paystub $paystub): PayPeriodResource
    {
        $this->authorize('paystub', [
            $payPeriod,
            $paystub,
        ]);

        (new PayPeriodPaystubService())
            ->addPaystubToPayPeriod(
                $payPeriod->id,
                $paystub->id
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
                $payPeriod->id,
                $paystub->id
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
