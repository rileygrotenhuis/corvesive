<?php

namespace Tests\Endpoint\PayPeriodSaving;

use App\Models\PayPeriod;
use App\Models\PayPeriodSaving;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroyPayPeriodSavingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Saving $saving;

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
        ]);
    }

    public function test_successful_pay_period_to_saving_unlink(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertEquals(0, PayPeriodSaving::count());
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
        return $this->deleteJson(
            route('pay-periods.savings.destroy', [
                $this->payPeriod,
                $this->saving,
            ])
        );
    }
}
