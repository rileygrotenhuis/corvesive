<?php

namespace Tests\Endpoint\PayPeriodPaystub;

use App\Models\PayPeriod;
use App\Models\Paystub;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StorePayPeriodPaystubTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Paystub $paystub;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();

        $this->paystub = Paystub::factory()
            ->for($this->user)
            ->create();
    }

    public function test_successful_pay_period_to_paystub_link(): void
    {
        $this->assertDatabaseHas('pay_periods', [
            'id' => $this->payPeriod->id,
            'total_balance' => 0,
        ]);

        $this->submitRequest($this->paystub)
            ->assertStatus(200);

        $this->assertDatabaseHas('pay_period_paystub', [
            'pay_period_id' => $this->payPeriod->id,
            'paystub_id' => $this->paystub->id,
        ]);

        $this->assertDatabaseHas('pay_periods', [
            'id' => $this->payPeriod->id,
            'total_balance' => $this->paystub->amount,
        ]);
    }

    public function test_failed_pay_period_to_paystub_link_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $newPaystub = Paystub::factory()
            ->for($newUser)
            ->create();

        $this->submitRequest($newPaystub)
            ->assertStatus(403);
    }

    protected function submitRequest(Paystub $paystub): TestResponse
    {
        return $this->postJson(
            route('pay-periods.paystubs.store', [
                $this->payPeriod,
                $paystub,
            ]),
        );
    }
}
