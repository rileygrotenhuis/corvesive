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

    public function setUp(): void
    {
        $this->payPeriodBillService = new PayPeriodBillService();
        $this->dueDate = Carbon::today()->addDays(10)->toDateString();
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
            'late',
            $this->payPeriodBillService->getPayPeriodBillStatus(
                false,
                $this->dueDate
            )
        );
    }

    public function test_pay_period_bill_late_status_on_same_day(): void
    {
        Carbon::setTestNow(Carbon::today()->addDays(10));

        $this->assertEquals(
            'late',
            $this->payPeriodBillService->getPayPeriodBillStatus(
                false,
                $this->dueDate
            )
        );
    }

    public function test_pay_period_bill_upcoming_status(): void
    {
        Carbon::setTestNow(Carbon::today()->addDays(9));

        $this->assertEquals(
            'upcoming',
            $this->payPeriodBillService->getPayPeriodBillStatus(
                false,
                $this->dueDate
            )
        );
    }
}
