<?php

namespace Tests\Endpoint\PayPeriodComplete;

use App\Models\PayPeriod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CompletePayPeriodTest extends TestCase
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
            ->create([
                'start_date' => Carbon::today()->subDays(20)->toDateString(),
                'end_date' => Carbon::today()->toDateString(),
            ]);
    }

    public function test_successful_pay_period_completion(): void
    {
        $this->assertDatabaseHas('pay_periods', [
            'user_id' => $this->user->id,
            'start_date' => Carbon::today()->toDateString(),
            'is_complete' => 0,
        ]);

        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('pay_periods', [
            'user_id' => $this->user->id,
            'start_date' => Carbon::today()->toDateString(),
            'is_complete' => 1,
        ]);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->putJson(
            route('pay-periods.complete', $this->payPeriod)
        );
    }
}
