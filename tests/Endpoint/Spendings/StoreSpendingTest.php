<?php

namespace Endpoint\Spendings;

use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StoreSpendingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();

        $this->authenticatesUser($this->user);

        $this->payload = [
            'total_balance' => 100000,
        ];
    }

    public function test_successful_spending_creation(): void
    {
        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('spendings', [
            'total_balance' => 100000,
            'remaining_balance' => 100000,
        ]);
    }

    public function test_failed_spending_creation_with_missing_balance_field(): void
    {
        unset($this->payload['total_balance']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('total_balance');
    }

    public function test_failed_spending_creation_with_invalid_balance_field(): void
    {
        $this->payload['total_balance'] = -100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('total_balance');
    }

    public function test_failed_spending_creation_with_unauthorized_user(): void
    {
        $newUser = User::factory()->create();
        $this->payPeriod->user_id = $newUser->id;
        $this->payPeriod->save();

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson(
            route('pay-periods.spendings.store', $this->payPeriod),
            $this->payload
        );
    }
}
