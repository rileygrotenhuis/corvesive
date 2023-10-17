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

        $this->payPeriodBudget::factory()
            ->for($this->payperiod)
            ->for($this->budget)
            ->create();

        $this->payload = [];
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
