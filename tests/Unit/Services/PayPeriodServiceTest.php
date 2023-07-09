<?php

namespace Tests\Unit\Services;

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
}
