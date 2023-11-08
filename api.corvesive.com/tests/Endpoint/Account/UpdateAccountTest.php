<?php

namespace Tests\Endpoint\Account;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateAccountTest extends TestCase
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
            'first_name' => 'Dev',
            'last_name' => 'Admin',
            'email' => 'admin@corvesive.com',
            'phone_number' => '0001112222',
        ];
    }

    public function test_successful_account_update(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'first_name' => 'Dev',
            'last_name' => 'Admin',
            'email' => 'admin@corvesive.com',
            'phone_number' => '0001112222',
        ]);
    }

    public function test_successful_account_update_with_no_email_change(): void
    {
        $this->user->email = 'admin@corvesive.com';
        $this->user->save();

        $this->submitRequest()
            ->assertStatus(200);
    }

    public function test_registration_fails_when_missing_first_name()
    {
        unset($this->payload['first_name']);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('first_name');
    }

    public function test_registration_fails_when_invalid_email()
    {
        $this->payload['email'] = 'dev';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('email');
    }

    public function test_registration_fails_when_email_already_exists()
    {
        User::factory()->create([
            'email' => 'admin@corvesive.com',
        ]);

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('email');
    }

    public function test_registration_fails_when_phone_number_is_invalid()
    {
        $this->payload['phone_number'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('phone_number');
    }

    protected function submitRequest(): TestResponse
    {
        return $this->putJson(
            route('account.update', $this->user),
            $this->payload
        );
    }
}
