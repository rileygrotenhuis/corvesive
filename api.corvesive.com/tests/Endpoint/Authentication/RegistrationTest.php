<?php

namespace Tests\Endpoint\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected array $payload = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->payload = [
            'first_name' => 'Dev',
            'last_name' => 'Admin',
            'email' => 'admin@corvesive.com',
            'phone_number' => '0001112222',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
    }

    public function test_successful_registration(): void
    {
        $this->submitRequest()
            ->assertStatus(201)
            ->assertJsonStructure([
                'user',
                'token',
            ]);

        $this->assertDatabaseHas('users', [
            'first_name' => 'Dev',
            'last_name' => 'Admin',
            'email' => 'admin@corvesive.com',
            'phone_number' => '0001112222',
        ]);

        $this->assertDatabaseCount('personal_access_tokens', 1);
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

    public function test_registration_fails_when_password_is_too_short()
    {
        $this->payload['password'] = 'foo';
        $this->payload['password_confirmation'] = 'foo';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('password');
    }

    public function test_registration_fails_when_passwords_do_not_match()
    {
        $this->payload['password_confirmation'] = 'foo';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('password');
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson(
            route('register'),
            $this->payload
        );
    }
}
