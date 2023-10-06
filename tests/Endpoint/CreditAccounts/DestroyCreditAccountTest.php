<?php

namespace Tests\Endpoint\CreditAccounts;

use App\Models\CreditAccount;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroyCreditAccountTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected CreditAccount $creditAccount;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->creditAccount = CreditAccount::factory()
            ->for($this->user)
            ->create();
    }

    public function test_successful_credit_account_deletion(): void
    {
        $this->submitRequest()
            ->assertStatus(204);

        $this->assertSoftDeleted($this->creditAccount);
    }

    public function test_failed_credit_account_deletion_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->deleteJson(
            route('credit-accounts.destroy', $this->creditAccount)
        );
    }
}
