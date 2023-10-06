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
                'amount' => 100000,
            ]);

        $this->payload = [
            'expense_type' => 'bill',
            'expense_id' => $this->payPeriodBill->id,
        ];
    }

    public function test_successful_bill_payment_transaction(): void
    {
        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('transactions', [
            'transactionable_id' => $this->payPeriodBill->id,
            'transactionable_type' => 'App\Models\PayPeriodBill',
            'type' => 'payment',
            'amount' => 100000,
        ]);

        $this->assertDatabaseHas('pay_period_bill', [
            'id' => $this->payPeriodBill->id,
            'has_payed' => 1,
        ]);
    }

    public function test_failed_bill_transaction_with_missing_expense_type_field(): void
    {
        unset($this->payload['expense_type']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('expense_type');
    }

    public function test_failed_bill_transaction_with_invalid_expense_type_field(): void
    {
        $this->payload['expense_type'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('expense_type');
    }

    public function test_failed_bill_transaction_with_invalid_expense_id_field(): void
    {
        $this->payload['expense_id'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('expense_id');
    }

    public function test_failed_budget_transaction_with_unknown_expense_id_field(): void
    {
        $this->payload['expense_id'] = 10000;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('expense_id');
    }

    public function test_failed_bill_transaction_with_invalid_amount_field(): void
    {
        $this->payload['amount'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson(
            route('transactions.store'),
            $this->payload
        );
    }
}
