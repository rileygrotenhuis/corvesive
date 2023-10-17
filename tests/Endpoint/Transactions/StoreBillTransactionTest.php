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

    protected array $payload;

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
                'amount' => 100000
            ]);

        $this->payload = [
            'pay_period_bill_id' => $this->payPeriodBill->id
        ];
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
        ]);
    }

    protected function test_failed_bill_transaction_with_missing_bill_value(): void
    {
    }

    protected function test_failed_bill_transaction_with_invalid_bill_value(): void
    {
    }

    protected function test_failed_bill_transaction_with_multiple_expense_types(): void
    {
    }

    protected function test_failed_bill_transaction_with_no_expense_values(): void
    {
    }

    protected function test_failed_bill_transaction_with_no_authorization(): void
    {
    }

    protected function submitRequest(PayPeriodBill $payPeriodBill): TestResponse
    {
        return $this->postJson(
            route('pay-periods.bills.transaction', [
                $this->payPeriod,
                $payPeriodBill,
            ]),
            $this->payload
        );
    }
}
