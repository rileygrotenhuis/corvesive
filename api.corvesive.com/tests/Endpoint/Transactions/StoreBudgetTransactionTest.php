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
            'amount' => 10000,
        ];
    }

    public function test_successful_budget_transaction_payment(): void
    {
        $this->submitRequest($this->payPeriodBudget)
            ->assertStatus(201);

        $this->assertDatabaseHas('transactions', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'pay_period_budget_id' => $this->payPeriodBudget->id,
            'pay_period_bill_id' => null,
            'type' => 'payment',
            'amount' => $this->payload['amount'],
            'notes' => null,
        ]);

        $this->assertDatabaseHas('pay_period_budget', [
            'id' => $this->payPeriodBudget->id,
            'total_balance' => $this->payPeriodBudget->total_balance,
            'remaining_balance' => 90000,
        ]);
    }

    public function test_failed_budget_transaction_with_missing_amount_value(): void
    {
        unset($this->payload['amount']);

        $this->submitRequest($this->payPeriodBudget)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_budget_transaction_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = 'invalid';

        $this->submitRequest($this->payPeriodBudget)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_budget_transaaction_with_no_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $newBudget = Budget::factory()
            ->for($newUser)
            ->create();

        $newPayPeriodBudget = PayPeriodBudget::factory()
            ->for($newBudget)
            ->create();

        $this->submitRequest($newPayPeriodBudget)
            ->assertStatus(403);
    }

    protected function submitRequest(PayPeriodBudget $payPeriodBudget): TestResponse
    {
        return $this->postJson(
            route('pay-periods.budgets.transaction', [
                $this->payPeriod,
                $payPeriodBudget,
            ]),
            $this->payload
        );
    }
}
