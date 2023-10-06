<?php

namespace Endpoint\Spendings;

use App\Models\PayPeriod;
use App\Models\Spending;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateSpendingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Spending $spending;

    protected array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();

        $this->spending = Spending::factory()
            ->for($this->user)
            ->create([
                'total_balance' => 100000,
                'remaining_balance' => 100000,
            ]);

        $this->payload = [
            'total_balance' => 50000,
            'remaining_balance' => 25000,
        ];
    }

    public function test_successful_spending_update(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('spendings', [
            'id' => $this->spending->id,
            'total_balance' => 50000,
            'remaining_balance' => 25000,
        ]);
    }

    public function test_failed_spending_update_with_missing_balance_field(): void
    {
        unset($this->payload['total_balance']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('total_balance');
    }

    public function test_failed_spending_update_with_invalid_balance_field(): void
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

    public function test_failed_spending_update_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->putJson(
            route('pay-periods.spendings.update', [
                $this->payPeriod,
                $this->spending,
            ]),
            $this->payload
        );
    }
}
