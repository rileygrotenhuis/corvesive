<?php

namespace Tests\Endpoint\Spendings;

use App\Models\PayPeriod;
use App\Models\Spending;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroySpendingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Spending $spending;

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
            ->create();
    }

    public function test_successful_spending_deletion(): void
    {
        $this->submitRequest()
            ->assertStatus(204);

        $this->assertSoftDeleted($this->spending);
    }

    public function test_failed_spending_creation_with_unauthorized_user(): void
    {
        $newUser = User::factory()->create();
        $this->payPeriod->user_id = $newUser->id;
        $this->payPeriod->save();

        $this->submitRequest()
            ->assertStatus(403);
    }

    public function test_failed_spending_deletion_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->deleteJson(
            route('pay-periods.spendings.destroy', [
                $this->payPeriod,
                $this->spending,
            ])
        );
    }
}
