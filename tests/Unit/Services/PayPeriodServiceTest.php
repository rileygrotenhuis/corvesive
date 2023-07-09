<?php

namespace Tests\Unit\Services;

use App\Models\PayPeriod;
use App\Models\User;
use App\Services\PayPeriodService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PayPeriodServiceTest extends TestCase
{
    use RefreshDatabase;

    protected PayPeriodService $payPeriodService;

    protected User $user;

    protected string $startDate;

    protected string $endDate;

    protected int $totalBalance;

    public function setUp(): void
    {
        parent::setUp();
        $this->payPeriodService = new PayPeriodService();
        $this->user = User::factory()->create();
        $this->startDate = Carbon::now()->toDateString();
        $this->endDate = Carbon::now()->addDays(15)->toDateString();
        $this->totalBalance = 100000;
    }

    public function test_that_pay_period_is_created(): void
    {
        $this->payPeriodService->createPayPeriod(
            $this->user,
            $this->startDate,
            $this->endDate,
            $this->totalBalance
        );

        $this->assertDatabaseHas('pay_periods', [
            'user_id' => $this->user->id,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_balance' => $this->totalBalance,
        ]);
    }

    public function test_that_pay_period_is_updated(): void
    {
        $payPeriod = PayPeriod::factory()->create([
            'user_id' => $this->user->id,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_balance' => $this->totalBalance,
        ]);

        $this->assertDatabaseHas('pay_periods', [
            'user_id' => $this->user->id,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_balance' => $this->totalBalance,
        ]);

        $this->payPeriodService->updatePayPeriod(
            $payPeriod,
            Carbon::now()->addDays(5)->toDateString(),
            Carbon::now()->addDays(20)->toDateString(),
            250000
        );

        $this->assertDatabaseHas('pay_periods', [
            'user_id' => $this->user->id,
            'start_date' => Carbon::now()->addDays(5)->toDateString(),
            'end_date' => Carbon::now()->addDays(20)->toDateString(),
            'total_balance' => 250000,
        ]);
    }

    public function test_that_pay_period_is_deleted(): void
    {
        $payPeriod = PayPeriod::factory()->create([
            'user_id' => $this->user->id,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_balance' => $this->totalBalance,
        ]);

        $this->assertDatabaseHas('pay_periods', [
            'user_id' => $this->user->id,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_balance' => $this->totalBalance,
        ]);

        $this->payPeriodService->deletePayPeriod($payPeriod);

        $this->assertSoftDeleted('pay_periods', [
            'user_id' => $this->user->id,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_balance' => $this->totalBalance,
        ]);
    }
}
