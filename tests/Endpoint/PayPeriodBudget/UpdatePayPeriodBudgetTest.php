<?php

namespace Tests\Endpoint\PayPeriodBudget;

use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\PayPeriodBudget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdatePayPeriodBudgetTest extends TestCase
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

        PayPeriodBudget::factory()->create([
            'pay_period_id' => $this->payPeriod->id,
            'budget_id' => $this->budget->id,
            'total_balance' => 100000,
            'remaining_balance' => 100000,
        ]);

        $this->payload = [
            'total_balance' => 10000,
            'remaining_balance' => 10000,
        ];
    }

    public function test_successful_pay_period_budget_update(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('pay_period_budget', [
            'pay_period_id' => $this->payPeriod->id,
            'budget_id' => $this->budget->id,
            'total_balance' => 10000,
            'remaining_balance' => 10000,
        ]);
    }

    public function test_failed_pay_period_to_budget_link_with_missing_remaining_balance_value(): void
    {
        unset($this->payload['remaining_balance']);

        $this->submitRequest()
            ->assertJsonValidationErrorFor('remaining_balance');
    }

    public function test_failed_pay_period_to_budget_link_with_invalid_remaining_balance_value(): void
    {
        $this->payload['remaining_balance'] = 'invalid';

        $this->submitRequest()
            ->assertJsonValidationErrorFor('remaining_balance');
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
        return $this->putJson(
            route('pay-periods.budgets.update', [
                $this->payPeriod,
                $this->budget,
            ]),
            $this->payload
        );
    }
}
