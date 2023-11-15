<?php

namespace Tests\Endpoint\PayPeriodSaving;

use App\Models\PayPeriod;
use App\Models\PayPeriodSaving;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdatePayPeriodSavingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Saving $saving;

    protected array $payload = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();

        $this->saving = Saving::factory()
            ->for($this->user)
            ->create();

        PayPeriodSaving::factory()->create([
            'pay_period_id' => $this->payPeriod->id,
            'saving_id' => $this->saving->id,
            'amount' => 50000,
        ]);

        $this->payload = [
            'amount' => 100000,
        ];
    }

    public function test_successful_pay_period_saving_update(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('pay_period_saving', [
            'pay_period_id' => $this->payPeriod->id,
            'saving_id' => $this->saving->id,
            'amount' => 100000,
        ]);
    }

    public function test_failed_pay_period_to_saving_link_with_missing_amount_value(): void
    {
        unset($this->payload['amount']);

        $this->submitRequest()
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_pay_period_to_saving_link_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = 'invalid';

        $this->submitRequest()
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_pay_period_to_saving_link_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->saving = Saving::factory()
            ->for($newUser)
            ->create();

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->putJson(
            route('pay-periods.savings.update', [
                $this->payPeriod,
                $this->saving,
            ]),
            $this->payload
        );
    }
}
