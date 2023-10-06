<?php

namespace Tests\Endpoint\PayPeriods;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StorePayPeriodTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected array $payload = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payload = [
            'start_date' => Carbon::now()->toDateString(),
            'end_date' => Carbon::now()->addDays(20)->toDateString(),
        ];
    }

    public function test_successful_pay_period_creation(): void
    {
        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('pay_periods', [
            'user_id' => $this->user->id,
            'start_date' => Carbon::today()->toDateString(),
            'end_date' => Carbon::today()->addDays(20)->toDateString(),
        ]);
    }

    public function test_failed_pay_period_creation_with_missing_start_date(): void
    {
        unset($this->payload['start_date']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('start_date');
    }

    public function test_failed_pay_period_creation_with_invalid_start_date_value(): void
    {
        $this->payload['start_date'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('start_date');
    }

    public function test_failed_pay_period_creation_with_end_date_after_start(): void
    {
        $this->payload['end_date'] = Carbon::today()->subDays(20)->toDateString();

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('end_date');
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson(
            route('pay-periods.store'),
            $this->payload
        );
    }
}
