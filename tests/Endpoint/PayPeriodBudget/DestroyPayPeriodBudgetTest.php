<?php

namespace Tests\Endpoint\PayPeriodBudget;

use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\PayPeriodBudget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroyPayPeriodBudgetTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Budget $budget;

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

        PayPeriodBudget::factory()->create([
            'pay_period_id' => $this->payPeriod->id,
            'budget_id' => $this->budget->id,
        ]);
    }

    public function test_successful_pay_period_to_budget_unlink(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseCount('pay_period_budget', 0);
    }

    public function test_failed_pay_period_to_budget_link_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->budget = Budget::factory()
            ->for($newUser)
            ->create();

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->deleteJson(
            route('pay-periods.budgets.destroy', [
                $this->payPeriod,
                $this->budget,
            ])
        );
    }
}
