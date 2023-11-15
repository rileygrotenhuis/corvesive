<?php

namespace Tests\Unit\PayPeriodBillService;

use App\Models\Bill;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\User;
use App\Services\PayPeriods\PayPeriodBillService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateAutoPaymentBillsTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);
    }

    public function test_job_updates_auto_payment_bills()
    {
        $payPeriod = PayPeriod::factory()->for($this->user)->create();

        $bill = Bill::factory()->for($this->user)->create([
            'is_automatic' => true,
        ]);

        $payPeriodBill = PayPeriodBill::factory()->for($payPeriod)->for($bill)->create([
            'due_date' => Carbon::today()->toDateString(),
            'is_automatic' => true,
        ]);

        $this->assertDatabaseHas('pay_period_bill', [
            'id' => $payPeriodBill->id,
            'has_payed' => 0,
        ]);

        resolve(PayPeriodBillService::class)->updateAutoPaymentBills();

        $this->assertDatabaseHas('pay_period_bill', [
            'id' => $payPeriodBill->id,
            'has_payed' => 1,
        ]);
    }

    public function test_job_does_not_update_normal_bills()
    {
        $payPeriod = PayPeriod::factory()->for($this->user)->create();

        $bill = Bill::factory()->create([
            'is_automatic' => false,
        ]);

        $payPeriodBill = PayPeriodBill::factory()->for($payPeriod)->for($bill)->create([
            'due_date' => Carbon::today()->toDateString(),
            'is_automatic' => false,
        ]);

        $this->assertDatabaseHas('pay_period_bill', [
            'id' => $payPeriodBill->id,
            'has_payed' => 0,
        ]);

        resolve(PayPeriodBillService::class)->updateAutoPaymentBills();

        $this->assertDatabaseHas('pay_period_bill', [
            'id' => $payPeriodBill->id,
            'has_payed' => 0,
        ]);
    }

    public function test_job_does_not_update_bills_not_due_today()
    {
        $payPeriod = PayPeriod::factory()->for($this->user)->create();

        $bill = Bill::factory()->create([
            'is_automatic' => true,
        ]);

        $payPeriodBill = PayPeriodBill::factory()->for($payPeriod)->for($bill)->create([
            'due_date' => Carbon::today()->addDays(5)->toDateString(),
            'is_automatic' => true,
        ]);

        $this->assertDatabaseHas('pay_period_bill', [
            'id' => $payPeriodBill->id,
            'has_payed' => 0,
        ]);

        resolve(PayPeriodBillService::class)->updateAutoPaymentBills();

        $this->assertDatabaseHas('pay_period_bill', [
            'id' => $payPeriodBill->id,
            'has_payed' => 0,
        ]);
    }
}
