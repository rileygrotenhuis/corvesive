<?php

namespace Tests\Endpoint\PayPeriodBudget;

use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StorePayPeriodBudgetTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Budget $budget;

    protected array $payload = [];

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

        $this->payload = [
            'total_balance' => 100000,
        ];
    }

    public function test_successful_pay_period_to_budget_link(): void
    {
        $this->submitRequest($this->budget)
            ->assertStatus(200);

        $this->assertDatabaseHas('pay_period_budget', [
            'pay_period_id' => $this->payPeriod->id,
            'budget_id' => $this->budget->id,
            'total_balance' => 100000,
            'remaining_balance' => 100000,
        ]);
    }

    public function test_failed_pay_period_to_budget_link_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $newBudget = Budget::factory()
            ->for($newUser)
            ->create();

        $this->submitRequest($newBudget)
            ->assertStatus(403);
    }

    protected function submitRequest(Budget $budget): TestResponse
    {
        return $this->postJson(
            route('pay-periods.budgets.store', [
                $this->payPeriod, $budget,
            ]),
            $this->payload
        );
    }
}
