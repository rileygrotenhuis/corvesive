<?php

namespace Tests\Endpoint\PayPeriods;

use App\Models\PayPeriod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdatePayPeriodTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected array $payload = [];

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

        $this->payload = [
            'start_date' => Carbon::today()->toDateString(),
            'end_date' => Carbon::today()->addDays(20)->toDateString(),
            'total_balance' => 100000,
        ];
    }

    public function test_successful_pay_period_update(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('pay_periods', [
            'user_id' => $this->user->id,
            'start_date' => Carbon::today()->toDateString(),
            'end_date' => Carbon::today()->addDays(20)->toDateString(),
            'total_balance' => 100000,
        ]);
    }

    public function test_failed_pay_period_update_with_missing_start_date(): void
    {
        unset($this->payload['start_date']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('start_date');
    }

    public function test_failed_pay_period_update_with_invalid_start_date_value(): void
    {
        $this->payload['start_date'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('start_date');
    }

    public function test_failed_pay_period_update_with_missing_total_balance_value(): void
    {
        unset($this->payload['total_balance']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('total_balance');
    }

    public function test_failed_pay_period_update_with_invalid_total_balance_value(): void
    {
        $this->payload['total_balance'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('total_balance');
    }

    public function test_failed_pay_period_update_with_end_date_after_start(): void
    {
        $this->payload['end_date'] = Carbon::today()->subDays(20)->toDateString();

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('end_date');
    }

    public function test_failed_authorization_to_update_pay_period(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->putJson(
            route('pay-periods.update', $this->payPeriod),
            $this->payload
        );
    }
}
