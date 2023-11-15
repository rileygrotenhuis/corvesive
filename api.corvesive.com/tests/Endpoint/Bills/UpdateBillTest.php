<?php

namespace Tests\Endpoint\Bills;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateBillTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected Bill $bill;

    protected array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->bill = Bill::factory()
            ->for($this->user)
            ->create([
                'issuer' => 'Test',
                'name' => 'Test',
                'amount' => 10000,
                'due_date' => 1,
                'notes' => 'This is a test',
            ]);

        $this->payload = [
            'issuer' => 'Updated Test',
            'name' => 'Updated Test',
            'amount' => 20000,
            'due_date' => 20,
            'is_automatic' => false,
            'notes' => 'This is an updated test',
        ];
    }

    public function test_successful_bill_update(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('bills', [
            'issuer' => 'Updated Test',
            'name' => 'Updated Test',
            'amount' => 20000,
            'due_date' => 20,
            'is_automatic' => 0,
            'notes' => 'This is an updated test',
        ]);
    }

    public function test_failed_bill_update_with_missing_issuer(): void
    {
        unset($this->payload['issuer']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('issuer');
    }

    public function test_failed_bill_update_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_bill_update_with_out_of_range_amount_value(): void
    {
        $this->payload['amount'] = -100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_bill_creation_with_invalid_due_date(): void
    {
        $this->payload['due_date'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('due_date');
    }

    public function test_failed_bill_creation_with_out_of_range_due_date(): void
    {
        $this->payload['due_date'] = 40;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('due_date');
    }

    public function test_failed_bill_update_with_invalid_notes_value(): void
    {
        $this->payload['notes'] = 100;

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('notes');
    }

    public function test_failed_bill_update_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->putJson(
            route('bills.update', $this->bill),
            $this->payload
        );
    }
}
