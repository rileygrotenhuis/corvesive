<?php

namespace Tests\Endpoint\PayPeriodPaystub;

use App\Models\PayPeriod;
use App\Models\PayPeriodPaystub;
use App\Models\Paystub;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdatePayPeriodPaystubTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Paystub $paystub;

    protected array $payload = [];

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

        PayPeriodPaystub::factory()->create([
            'pay_period_id' => $this->payPeriod->id,
            'paystub_id' => $this->paystub->id,
            'amount' => 100000,
        ]);

        $this->payload = [
            'amount' => 200000,
        ];
    }

    public function test_successful_pay_period_paystub_update(): void
    {
        $this->assertDatabaseHas('pay_period_paystub', [
            'pay_period_id' => $this->payPeriod->id,
            'paystub_id' => $this->paystub->id,
            'amount' => 100000,
        ]);

        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('pay_period_paystub', [
            'pay_period_id' => $this->payPeriod->id,
            'paystub_id' => $this->paystub->id,
            'amount' => 200000,
        ]);
    }

    public function test_failed_pay_period_to_paystub_link_with_missing_amount_value(): void
    {
        unset($this->payload['amount']);

        $this->submitRequest()
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_pay_period_to_paystub_link_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = 'invalid';

        $this->submitRequest()
            ->assertJsonValidationErrorFor('amount');
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
        return $this->putJson(
            route('pay-periods.paystubs.update', [
                $this->payPeriod,
                $this->paystub,
            ]),
            $this->payload
        );
    }
}
