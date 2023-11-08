<?php

namespace Tests\Endpoint\PayPeriods;

use App\Models\Bill;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroyPayPeriodTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();
    }

    public function test_successful_pay_period_deletion(): void
    {
        $this->submitRequest()
            ->assertStatus(204);

        $this->assertSoftDeleted($this->payPeriod);
    }

    public function test_successful_pay_period_deletion_with_attached_resources(): void
    {
        $budget = Budget::factory()
            ->for($this->user)
            ->create();

        $payPeriodBudget = PayPeriodBudget::factory()->create([
            'pay_period_id' => $this->payPeriod->id,
            'budget_id' => $budget->id,
        ]);

        $bill = Bill::factory()
            ->for($this->user)
            ->create();

        $payPeriodBill = PayPeriodBill::factory()->create([
            'pay_period_id' => $this->payPeriod->id,
            'bill_id' => $bill->id,
        ]);

        $this->submitRequest()
            ->assertStatus(204);

        $this->assertNotSoftDeleted($budget);
        $this->assertNotSoftDeleted($bill);
        $this->assertSoftDeleted($this->payPeriod);
        $this->assertSoftDeleted($payPeriodBudget);
        $this->assertSoftDeleted($payPeriodBill);
    }

    public function test_failed_pay_period_deletion_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->deleteJson(
            route('pay-periods.destroy', $this->payPeriod)
        );
    }
}
