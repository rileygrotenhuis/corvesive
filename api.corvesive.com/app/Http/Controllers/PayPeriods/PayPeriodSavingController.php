<?php

namespace App\Http\Controllers\PayPeriods;

use App\Exceptions\AlreadyAttachedToPayPeriod;
use App\Http\Controllers\Controller;
use App\Http\Resources\PayPeriods\PayPeriodResource;
use App\Http\Resources\PayPeriods\PayPeriodSavingResource;
use App\Models\PayPeriod;
use App\Models\PayPeriodSaving;
use App\Models\Saving;
use App\Services\PayPeriods\PayPeriodSavingService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PayPeriodSavingController extends Controller
{
    public function __construct(protected PayPeriodSavingService $payPeriodSavingService)
    {
    }

    public function index(PayPeriod $payPeriod): AnonymousResourceCollection
    {
        return PayPeriodSavingResource::collection(
            PayPeriodSaving::with('savingAccount')
                ->where('pay_period_id', $payPeriod->id)
                ->orderBy('pay_period_saving.amount', 'desc')
                ->get()
        );
    }

    public function store(Request $request, PayPeriod $payPeriod, Saving $saving): PayPeriodResource
    {
        $request->validate([
            'amount' => 'required|integer|min:0',
        ]);

        $this->authorize('savingAccount', [
            $payPeriod,
            $saving,
        ]);

        if ($this->payPeriodSavingService->savingIsAlreadyAttachedToPayPeriod($payPeriod, $saving)) {
            throw new AlreadyAttachedToPayPeriod();
        }

        $this->payPeriodSavingService
            ->addSavingToPayPeriod(
                $payPeriod,
                $saving,
                $request->amount,
            );

        return new PayPeriodResource($payPeriod);
    }

    public function update(Request $request, PayPeriod $payPeriod, Saving $saving): PayPeriodResource
    {
        $request->validate([
            'amount' => 'required|integer|min:0',
        ]);

        $this->authorize('savingAccount', [
            $payPeriod,
            $saving,
        ]);

        $this->payPeriodSavingService
            ->updatePayPeriodSaving(
                $payPeriod->id,
                $saving->id,
                $request->amount,
            );

        return new PayPeriodResource($payPeriod);
    }

    public function destroy(PayPeriod $payPeriod, Saving $saving): PayPeriodResource
    {
        $this->authorize('savingAccount', [
            $payPeriod,
            $saving,
        ]);

        $this->payPeriodSavingService
            ->removeSavingFromPayPeriod(
                $payPeriod,
                $saving
            );

        return new PayPeriodResource($payPeriod);
    }
}
