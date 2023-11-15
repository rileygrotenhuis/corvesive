<?php

namespace Tests\Endpoint\Savings;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroySavingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected Saving $saving;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->saving = Saving::factory()
            ->for($this->user)
            ->create();
    }

    public function test_successful_saving_deletion(): void
    {
        $this->submitRequest()
            ->assertStatus(204);

        $this->assertSoftDeleted($this->saving);
    }

    public function test_failed_saving_deletion_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->deleteJson(
            route('savings.destroy', $this->saving)
        );
    }
}
