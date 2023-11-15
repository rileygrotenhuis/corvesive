<?php

namespace Tests\Endpoint\Savings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StoreSavingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payload = [
            'name' => 'Test',
            'amount' => 10000,
            'notes' => 'This is a test',
        ];
    }

    public function test_successful_saving_creation(): void
    {
        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('savings', [
            'name' => 'Test',
            'amount' => 10000,
            'notes' => 'This is a test',
        ]);
    }

    public function test_successful_saving_creation_without_notes_value(): void
    {
        unset($this->payload['notes']);

        $this->submitRequest()
            ->assertStatus(201);

        $this->assertDatabaseHas('savings', [
            'name' => 'Test',
            'amount' => 10000,
            'notes' => null,
        ]);
    }

    public function test_failed_saving_creation_with_missing_name(): void
    {
        unset($this->payload['name']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('name');
    }

    public function test_failed_saving_creation_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_saving_creation_with_out_of_range_amount_value(): void
    {
        $this->payload['amount'] = -100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_saving_creation_with_invalid_notes_value(): void
    {
        $this->payload['notes'] = 100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('notes');
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson(
            route('savings.store'),
            $this->payload
        );
    }
}
