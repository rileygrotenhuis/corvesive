<?php

namespace Tests\Endpoint\Paystubs;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StorePaystubTest extends TestCase
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
            'issuer' => 'Enron',
            'type' => 'Paycheck',
            'amount' => 10000,
            'notes' => 'This is a test',
        ];
    }

    public function test_successful_paystub_creation(): void
    {
        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('paystubs', [
            'user_id' => $this->user->id,
            'issuer' => $this->payload['issuer'],
            'type' => $this->payload['type'],
            'amount' => $this->payload['amount'],
            'notes' => $this->payload['notes'],
        ]);
    }

    public function test_successful_paystub_creation_without_notes(): void
    {
        unset($this->payload['notes']);

        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('paystubs', [
            'user_id' => $this->user->id,
            'issuer' => $this->payload['issuer'],
            'amount' => $this->payload['amount'],
            'notes' => null,
        ]);
    }

    public function test_failed_paystub_creation_with_missing_issuer(): void
    {
        unset($this->payload['issuer']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('issuer');
    }

    public function test_failed_paystub_creation_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = -100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_paystub_creation_with_invalid_notes_value(): void
    {
        $this->payload['notes'] = 100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('notes');
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson(
            route('paystubs.store'),
            $this->payload
        );
    }
}
