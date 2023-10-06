<?php

namespace Tests\Endpoint\Transactions;

use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\PayPeriodBudget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StoreBudgetTransactionTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Budget $budget;

    protected PayPeriodBudget $payPeriodBudget;

    protected array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();

        $this->budget = Budget::factory()
            ->for($this->user)
            ->create();

        $this->payPeriodBudget = PayPeriodBudget::factory()
            ->for($this->payPeriod)
            ->for($this->budget)
            ->create([
                'total_balance' => 100000,
                'remaining_balance' => 100000,
            ]);

        $this->payload = [
            'expense_type' => 'budget',
            'expense_id' => $this->payPeriodBudget->id,
            'amount' => -50000,
        ];
    }

    public function test_successful_budget_payment_transaction(): void
    {
        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('transactions', [
            'transactionable_id' => $this->payPeriodBudget->id,
            'transactionable_type' => 'App\Models\PayPeriodBudget',
            'type' => 'payment',
            'amount' => -50000,
        ]);

        $this->assertDatabaseHas('pay_period_budget', [
            'id' => $this->payPeriodBudget->id,
            'total_balance' => 100000,
            'remaining_balance' => 50000,
        ]);
    }

    public function test_successful_budget_deposit_transaction(): void
    {
        $this->payload['amount'] = 50000;

        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('transactions', [
            'transactionable_id' => $this->payPeriodBudget->id,
            'transactionable_type' => 'App\Models\PayPeriodBudget',
            'type' => 'deposit',
            'amount' => 50000,
        ]);

        $this->assertDatabaseHas('pay_period_budget', [
            'id' => $this->payPeriodBudget->id,
            'total_balance' => 100000,
            'remaining_balance' => 150000,
        ]);
    }

    public function test_failed_budget_transaction_with_missing_expense_type_field(): void
    {
        unset($this->payload['expense_type']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('expense_type');
    }

    public function test_failed_budget_transaction_with_invalid_expense_type_field(): void
    {
        $this->payload['expense_type'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('expense_type');
    }

    public function test_failed_budget_transaction_with_invalid_expense_id_field(): void
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

    public function test_failed_budget_transaction_with_invalid_amount_field(): void
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
