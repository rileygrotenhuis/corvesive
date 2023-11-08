<?php

namespace Tests\Endpoint\Paystubs;

use App\Models\Paystub;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdatePaystubTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected Paystub $paystub;

    protected array $payload = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->paystub = Paystub::factory()
            ->for($this->user)
            ->create([
                'issuer' => 'SVB',
                'amount' => 5000,
                'notes' => 'This is a test',
            ]);

        $this->payload = [
            'issuer' => 'Enron',
            'amount' => 10000,
            'notes' => 'This is an updated test',
        ];
    }

    public function test_successful_paystub_update(): void
    {
        $this->assertDatabaseHas('paystubs', [
            'user_id' => $this->user->id,
            'issuer' => 'SVB',
            'amount' => 5000,
            'notes' => 'This is a test',
        ]);

        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('paystubs', [
            'user_id' => $this->user->id,
            'issuer' => $this->payload['issuer'],
            'amount' => $this->payload['amount'],
            'notes' => $this->payload['notes'],
        ]);
    }

    public function test_failed_paystub_update_with_missing_issuer(): void
    {
        unset($this->payload['issuer']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('issuer');
    }

    public function test_failed_paystub_update_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = -100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_paystub_update_with_invalid_notes_value(): void
    {
        $this->payload['notes'] = 100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('notes');
    }

    public function test_failed_authorization_to_update_paystub(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->putJson(
            route('paystubs.update', $this->paystub),
            $this->payload
        );
    }
}
