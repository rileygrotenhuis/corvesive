<?php

namespace Tests\Endpoint\Savings;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateSavingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected Saving $saving;

    protected array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->saving = Saving::factory()
            ->for($this->user)
            ->create([
                'name' => 'Test',
                'amount' => 10000,
                'notes' => 'This is a test',
            ]);

        $this->payload = [
            'name' => 'Updated Test',
            'amount' => 20000,
            'notes' => 'This is an updated test',
        ];
    }

    public function test_successful_saving_update(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('savings', [
            'name' => 'Updated Test',
            'amount' => 20000,
            'notes' => 'This is an updated test',
        ]);
    }

    public function test_failed_saving_update_with_missing_name(): void
    {
        unset($this->payload['name']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('name');
    }

    public function test_failed_saving_update_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_saving_update_with_out_of_range_amount_value(): void
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

    public function test_failed_saving_update_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->putJson(
            route('savings.update', $this->saving),
            $this->payload
        );
    }
}
