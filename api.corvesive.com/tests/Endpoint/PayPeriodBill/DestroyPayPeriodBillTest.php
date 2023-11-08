<?php

namespace Tests\Endpoint\PayPeriodBill;

use App\Models\Bill;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroyPayPeriodBillTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Bill $bill;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();

        $this->bill = Bill::factory()
            ->for($this->user)
            ->create();

        PayPeriodBill::factory()->create([
            'pay_period_id' => $this->payPeriod->id,
            'bill_id' => $this->bill->id,
        ]);
    }

    public function test_successful_pay_period_to_bill_unlink(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertEquals(0, PayPeriodBill::count());
    }

    public function test_failed_pay_period_to_bill_link_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->bill = Bill::factory()
            ->for($newUser)
            ->create();

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->deleteJson(
            route('pay-periods.bills.destroy', [
                $this->payPeriod,
                $this->bill,
            ])
        );
    }
}
