<?php

namespace Tests\Endpoint\PayPeriodCurrent;

use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StorePayPeriodCurrentTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();
    }

    public function test_successful_seting_pay_period_to_current(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
        ]);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson(
            route('pay-periods.current', [
                $this->payPeriod->id,
            ])
        );
    }
}
