<?php

namespace App\Http\Controllers\Paystubs;

use App\Events\Paystubs\PaystubCreated;
use App\Events\Paystubs\PaystubModified;
use App\Events\Paystubs\PaystubRescheduled;
use App\Helpers\DateHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Paystubs\StorePaystubRequest;
use App\Http\Requests\Paystubs\UpdatePaystubRequest;
use App\Models\Paystub;
use App\Repositories\PaystubRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Response;

class PaystubController extends Controller
{
    /**
     * Paystubs - Index Page.
     */
    public function index(Request $request): Response
    {
        $repository = new PaystubRepository($request->user());

        $allPaystubs = $repository->all();
        $monthlyPaystubs = $repository->monthly()->groupBy('monthYear');

        $monthSelectionOptions = DateHelpers::getMonthlySelectionOptions();

        return inertia('Paystubs/Index', [
            'paystubs' => $allPaystubs,
            'monthlyPaystubs' => $monthlyPaystubs,
            'monthSelectionOptions' => $monthSelectionOptions,
        ]);
    }

    /**
     * Paystubs - Create Page.
     */
    public function create(): Response
    {
        return inertia('Paystubs/Create');
    }

    /**
     * Creates a new Paystub.
     */
    public function store(StorePaystubRequest $request): RedirectResponse
    {
        $paystub = Paystub::add(
            $request->user(),
            $request->input('issuer'),
            $request->input('amount_in_cents'),
            $request->input('recurrence_rate'),
            $request->input('recurrence_interval_one'),
            $request->input('recurrence_interval_two'),
            $request->input('notes'),
        );

        /**
         * Schedules future instances of this Paystub
         * for the next 12 months
         */
        event(new PaystubCreated($paystub));

        return to_route('paystubs.index');
    }

    /**
     * Paystubs - Show Page.
     */
    public function show(Paystub $paystub): Response
    {
        Gate::authorize('isOwner', $paystub);

        return inertia('Paystubs/Show', [
            'paystub' => $paystub,
        ]);
    }

    /**
     * Updates an existing Paystub.
     */
    public function update(UpdatePaystubRequest $request, Paystub $paystub): RedirectResponse
    {
        Gate::authorize('isOwner', $paystub);

        $amountChanged = $paystub->amount_in_cents !== $request->input('amount_in_cents');

        $recurrenceChanged = (
            $paystub->recurrence_rate !== $request->input('recurrence_rate') ||
            $paystub->recurrence_interval_one !== $request->input('recurrence_interval_one') ||
            $paystub->recurrence_interval_two !== $request->input('recurrence_interval_two')
        );

        $paystub = $paystub->modify(
            $request->input('issuer'),
            $request->input('amount_in_cents'),
            $request->input('recurrence_rate'),
            $request->input('recurrence_interval_one'),
            $request->input('recurrence_interval_two'),
            $request->input('notes'),
        );

        /**
         * If ONLY the amount value changed, modify all
         * future instances of this Paystub
         */
        if ($amountChanged && ! $recurrenceChanged) {
            event(new PaystubModified($paystub));
        }

        /**
         * If the recurrence changed, unschedule
         * and reschedule all future instances of this Paystub
         */
        if ($recurrenceChanged) {
            event(new PaystubRescheduled($paystub));
        }

        return to_route('paystubs.show', $paystub);
    }

    /**
     * Removes an existing Paystub.
     */
    public function destroy(Paystub $paystub): RedirectResponse
    {
        Gate::authorize('isOwner', $paystub);

        $paystub->remove();

        return to_route('paystubs.index');
    }

    /**
     * Schedules an existing Paystub.
     */
    public function schedule(Request $request, Paystub $paystub): RedirectResponse
    {
        Gate::authorize('isOwner', $paystub);

        $request->validate([
            'pay_day' => ['required', 'date'],
        ]);

        $paystub->schedule(
            Carbon::parse($request->input('pay_day')),
            $paystub->amount_in_cents
        );

        return to_route('paystubs.index');
    }
}
