<?php

namespace Tests\Endpoint\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected array $payload = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'first_name' => 'Dev',
            'last_name' => 'Admin',
            'email' => 'admin@corvesive.com',
        ]);

        $this->payload = [
            'email' => 'admin@corvesive.com',
            'password' => 'password',
        ];
    }

    public function test_successful_login(): void
    {
        $this->submitRequest()
            ->assertStatus(200)
            ->assertJsonStructure([
                'user',
                'token',
            ])
            ->assertJson([
                'user' => [
                    'id' => $this->user->id,
                ],
            ]);
    }

    public function test_login_fails_when_incorrect_email()
    {
        $this->payload['email'] = 'wrongemail@dev.com';

        $this->submitRequest()
            ->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'email' => ['User does not exist with that email'],
                ],
            ]);
    }

    public function test_login_fails_when_incorrect_password()
    {
        $this->payload['password'] = 'incorrect';

        $this->submitRequest()
            ->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'password' => ['Invalid password'],
                ],
            ]);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson(
            route('login'),
            $this->payload
        );
    }
}
