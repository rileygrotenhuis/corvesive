<?php

namespace Tests\Endpoint\PayPeriodSaving;

use App\Models\PayPeriod;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StorePayPeriodSavingTest extends TestCase
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

        $this->payload = [
            'amount' => 100000,
        ];
    }

    public function test_successful_pay_period_to_saving_link(): void
    {
        $this->submitRequest($this->saving)
            ->assertStatus(200);

        $this->assertDatabaseHas('pay_period_saving', [
            'pay_period_id' => $this->payPeriod->id,
            'saving_id' => $this->saving->id,
            'amount' => 100000,
        ]);
    }

    public function test_failed_pay_period_to_saving_link_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $newSaving = Saving::factory()
            ->for($newUser)
            ->create();

        $this->submitRequest($newSaving)
            ->assertStatus(403);
    }

    protected function submitRequest(Saving $saving): TestResponse
    {
        return $this->postJson(
            route('pay-periods.savings.store', [
                $this->payPeriod, $saving,
            ]),
            $this->payload
        );
    }
}
