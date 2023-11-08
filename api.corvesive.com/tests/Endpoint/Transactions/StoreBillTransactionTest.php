<?php

namespace Tests\Endpoint\Transactions;

use App\Models\Bill;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StoreBillTransactionTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Bill $bill;

    protected PayPeriodBill $payPeriodBill;

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

        $this->payPeriodBill = PayPeriodBill::factory()
            ->for($this->payPeriod)
            ->for($this->bill)
            ->create([
                'amount' => 100000,
            ]);
    }

    public function test_successful_bill_transaction(): void
    {
        $this->submitRequest($this->payPeriodBill)
            ->assertStatus(201);

        $this->assertDatabaseHas('transactions', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'pay_period_bill_id' => $this->payPeriodBill->id,
            'pay_period_budget_id' => null,
            'type' => 'payment',
            'amount' => $this->payPeriodBill->amount,
            'notes' => null,
        ]);

        $this->assertDatabaseHas('pay_period_bill', [
            'id' => $this->payPeriodBill->id,
            'has_payed' => 1,
        ]);
    }

    public function test_failed_bill_transaction_with_no_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $newBill = Bill::factory()
            ->for($newUser)
            ->create();

        $newPayPeriodBill = PayPeriodBill::factory()
            ->for($newBill)
            ->create();

        $this->submitRequest($newPayPeriodBill)
            ->assertStatus(403);
    }

    protected function submitRequest(PayPeriodBill $payPeriodBill): TestResponse
    {
        return $this->postJson(
            route('pay-periods.bills.transaction', [
                $this->payPeriod,
                $payPeriodBill,
            ])
        );
    }
}
