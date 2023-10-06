<?php

namespace Tests\Endpoint\Bills;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroyBillTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected Bill $bill;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->bill = Bill::factory()
            ->for($this->user)
            ->create();
    }

    public function test_successful_bill_deletion(): void
    {
        $this->submitRequest()
            ->assertStatus(204);

        $this->assertSoftDeleted($this->bill);
    }

    public function test_failed_bill_deletion_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->deleteJson(
            route('bills.destroy', $this->bill)
        );
    }
}
