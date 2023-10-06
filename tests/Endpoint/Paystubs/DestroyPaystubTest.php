<?php

namespace Tests\Endpoint\Paystubs;

use App\Models\Paystub;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroyPaystubTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected Paystub $paystub;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->paystub = Paystub::factory()
            ->for($this->user)
            ->create();
    }

    public function test_successful_paystub_deletion(): void
    {
        $this->submitRequest()
            ->assertStatus(204);

        $this->assertSoftDeleted($this->paystub);
    }

    public function test_failed_paystub_deletion_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->deleteJson(
            route('paystubs.destroy', $this->paystub)
        );
    }
}
