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
            ->for($this->payPeriodc)
            ->for($this->budget)
            ->create([
                'amount' => 100000
            ]);

        $this->payload = [
            'pay_period_budget_id' => $this->payPeriodBudget->id,
            'amount' => -100
        ];
    }

    protected function test_successful_budget_transaction_deposit(): void
    {
    }

    protected function test_successful_budget_transaction_payment(): void
    {
    }

    protected function test_failed_budget_transaction_with_missing_budget_value(): void
    {
    }

    protected function test_failed_budget_transaction_with_invalid_budget_value(): void
    {
    }

    protected function test_failed_budget_transaction_with_no_expense_values(): void
    {
    }

    protected function test_failed_budget_transaction_with_missing_amount_value(): void
    {
    }

    protected function test_failed_budget_transaction_with_invalid_amount_value(): void
    {
    }

    protected function test_failed_budget_transaction_with_no_authorization(): void
    {
    }

    protected function submitRequest(Budget $budget): TestResponse
    {
        return $this->postJson(
            route('pay-periods.budgets.transaction', [
                $this->payPeriod,
                $budget,
            ]),
            $this->payload
        );
    }
}
