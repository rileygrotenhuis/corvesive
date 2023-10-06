<?php

namespace Tests\Endpoint\Budgets;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroyBudgetTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected Budget $budget;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->budget = Budget::factory()
            ->for($this->user)
            ->create();
    }

    public function test_successful_budget_deletion(): void
    {
        $this->submitRequest()
            ->assertStatus(204);

        $this->assertSoftDeleted($this->budget);
    }

    public function test_failed_budget_deletion_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->deleteJson(
            route('budgets.destroy', $this->budget)
        );
    }
}
