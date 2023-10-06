<?php

namespace Tests\Endpoint\CreditAccounts;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StoreCreditAccountTest extends TestCase
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
            'issuer' => 'Chase',
            'name' => 'Basic Card',
            'type' => 'visa',
            'credit_limit' => 100000,
            'interest_rate' => 0.25,
        ];
    }

    public function test_successful_credit_account_creation(): void
    {
        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('credit_accounts', [
            'issuer' => 'Chase',
            'name' => 'Basic Card',
            'type' => 'visa',
            'credit_limit' => 100000,
            'interest_rate' => 0.25,
        ]);
    }

    public function test_failed_credit_account_creation_with_missing_issuer_value(): void
    {
        unset($this->payload['issuer']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('issuer');
    }

    public function test_failed_credit_account_creation_with_type_outside_enum_scope(): void
    {
        $this->payload['type'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('type');
    }

    public function test_failed_credit_account_creation_with_invalid_credit_limit_value(): void
    {
        $this->payload['credit_limit'] = -100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('credit_limit');
    }

    public function test_failed_credit_account_creation_with_invalid_interest_rate_value(): void
    {
        $this->payload['interest_rate'] = 150;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('interest_rate');
    }

    public function test_failed_credit_account_creation_with_invalid_annual_fee_value(): void
    {
        $this->payload['annual_fee'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('annual_fee');
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson(
            route('credit-accounts.store'),
            $this->payload
        );
    }
}
