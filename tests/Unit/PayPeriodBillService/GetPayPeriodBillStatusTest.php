<?php

namespace Tests\Unit\PayPeriodBillService;

use App\Services\PayPeriodBillService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetPayPeriodBillStatusTest extends TestCase
{
    use RefreshDatabase;

    protected PayPeriodBillService $payPeriodBillService;

    protected string $dueDate;

    protected string $today;

    public function setUp(): void
    {
        $this->payPeriodBillService = new PayPeriodBillService();
        $this->dueDate = Carbon::tomorrow()->toDateString();
        $this->today = Carbon::today()->toDateString();
    }

    public function test_pay_period_bill_unpayed_status(): void
    {
        $this->assertEquals(
            'unpayed',
            $this->payPeriodBillService->getPayPeriodBillStatus(
                false,
                $this->dueDate
            )
        );
    }

    public function test_pay_period_bill_payed_status(): void
    {
        $this->assertEquals(
            'payed',
            $this->payPeriodBillService->getPayPeriodBillStatus(
                true,
                $this->dueDate
            )
        );
    }

    public function test_pay_period_bill_late_status(): void
    {
        Carbon::setTestNow(Carbon::today()->addDays(20));

        $this->assertEquals(
            'payed',
            $this->payPeriodBillService->getPayPeriodBillStatus(
                true,
                $this->dueDate
            )
        );
    }
}
