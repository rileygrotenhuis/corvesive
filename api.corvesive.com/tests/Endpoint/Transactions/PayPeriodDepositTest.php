<?php

namespace Tests\Endpoint\Transactions;

use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class PayPeriodDepositTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();

        $this->payload = [
            'amount' => 10000,
        ];
    }

    public function test_successful_pay_period_deposit(): void
    {
        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('transactions', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'pay_period_bill_id' => null,
            'pay_period_budget_id' => null,
            'type' => 'deposit',
            'amount' => $this->payload['amount'],
            'notes' => null,
        ]);
    }

    public function test_successful_pay_period_deposit_with_notes_field(): void
    {
        $this->payload['notes'] = 'This is a test';

        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('transactions', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'pay_period_bill_id' => null,
            'pay_period_budget_id' => null,
            'type' => 'deposit',
            'amount' => $this->payload['amount'],
            'notes' => 'This is a test',
        ]);
    }

    public function test_failed_pay_period_deposit_with_missing_amount_value(): void
    {
        unset($this->payload['amount']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_pay_period_deposit_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson(
            route('pay-periods.deposit', $this->payPeriod),
            $this->payload
        );
    }
}
