<?php

namespace Tests\Unit\Services;

use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\User;
use App\Services\BudgetService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BudgetServiceTest extends TestCase
{
    use RefreshDatabase;

    protected BudgetService $budgetService;

    protected User $user;

    protected PayPeriod $payPeriod;

    public function setUp(): void
    {
        parent::setUp();
        $this->budgetService = new BudgetService();
        $this->user = User::factory()->create();
        $this->payPeriod = PayPeriod::factory()->for($this->user)->create();
    }

    public function test_that_budget_is_created(): void
    {
        $this->budgetService->createBudget(
            $this->user,
            $this->payPeriod,
            'Test',
            10000
        );

        $this->assertDatabaseHas('budgets', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'remaining_balance' => 10000,
        ]);
    }

    public function test_that_budget_is_updated(): void
    {
        $budget = Budget::factory()
            ->for($this->payPeriod)
            ->for($this->user)
            ->create([
                'name' => 'Test',
                'amount' => 10000,
                'remaining_balance' => 10000,
            ]);

        $this->assertDatabaseHas('budgets', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'remaining_balance' => 10000,
        ]);

        $this->budgetService->updateBudget(
            $budget,
            'Updated Test',
            25000
        );

        $this->assertDatabaseHas('budgets', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Updated Test',
            'amount' => 25000,
            'remaining_balance' => 25000,
        ]);
    }

    public function test_that_budget_is_deleted(): void
    {
        $budget = Budget::factory()
            ->for($this->payPeriod)
            ->for($this->user)
            ->create([
                'name' => 'Test',
                'amount' => 10000,
                'remaining_balance' => 10000,
            ]);

        $this->assertDatabaseHas('budgets', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'remaining_balance' => 10000,
        ]);

        $this->budgetService->deleteBudget($budget);

        $this->assertSoftDeleted('budgets', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'remaining_balance' => 10000,
        ]);
    }
}
