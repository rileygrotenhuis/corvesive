<?php

namespace Tests\Endpoint\Budgets;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateBudgetTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected Budget $budget;

    protected array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->budget = Budget::factory()
            ->for($this->user)
            ->create([
                'name' => 'Test',
                'amount' => 10000,
                'notes' => 'This is a test',
            ]);

        $this->payload = [
            'name' => 'Updated Test',
            'amount' => 20000,
            'notes' => 'This is an updated test',
        ];
    }

    public function test_successful_budget_update(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('budgets', [
            'name' => 'Updated Test',
            'amount' => 20000,
            'notes' => 'This is an updated test',
        ]);
    }

    public function test_failed_budget_update_with_missing_name(): void
    {
        unset($this->payload['name']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('name');
    }

    public function test_failed_budget_update_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_budget_update_with_out_of_range_amount_value(): void
    {
        $this->payload['amount'] = -100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_budget_creation_with_invalid_notes_value(): void
    {
        $this->payload['notes'] = 100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('notes');
    }

    public function test_failed_budget_update_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->putJson(
            route('budgets.update', $this->budget),
            $this->payload
        );
    }
}
