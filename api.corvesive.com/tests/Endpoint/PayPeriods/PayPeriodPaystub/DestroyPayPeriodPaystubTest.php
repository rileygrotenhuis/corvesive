<?php

namespace Tests\Endpoint\PayPeriods\PayPeriodPaystub;

use App\Models\PayPeriod;
use App\Models\PayPeriodPaystub;
use App\Models\Paystub;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroyPayPeriodPaystubTest extends TestCase
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

        $this->paystub = Paystub::factory()
            ->for($this->user)
            ->create();

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();

        PayPeriodPaystub::factory()->create([
            'pay_period_id' => $this->payPeriod->id,
            'paystub_id' => $this->paystub->id,
        ]);
    }

    public function test_successful_pay_period_to_paystub_unlink(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertEquals(0, PayPeriodPaystub::count());
    }

    public function test_failed_pay_period_to_paystub_link_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->paystub = Paystub::factory()
            ->for($newUser)
            ->create();

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->deleteJson(
            route('pay-periods.paystubs.destroy', [
                $this->payPeriod,
                $this->paystub,
            ])
        );
    }
}
