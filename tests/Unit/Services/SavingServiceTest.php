<?php

namespace Tests\Unit\Services;

use App\Models\PayPeriod;
use App\Models\Saving;
use App\Models\User;
use App\Services\SavingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SavingServiceTest extends TestCase
{
    use RefreshDatabase;

    protected SavingService $savingService;

    protected User $user;

    protected PayPeriod $payPeriod;

    public function setUp(): void
    {
        parent::setUp();
        $this->savingService = new SavingService();
        $this->user = User::factory()->create();
        $this->payPeriod = PayPeriod::factory()->for($this->user)->create();
    }

    public function test_that_saving_is_created(): void
    {
        $this->savingService->createSaving(
            $this->user,
            $this->payPeriod,
            'Test',
            10000
        );

        $this->assertDatabaseHas('savings', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'has_payed' => false,
        ]);
    }

    public function test_that_saving_is_updated(): void
    {
        $saving = Saving::factory()
            ->for($this->payPeriod)
            ->for($this->user)
            ->create([
                'name' => 'Test',
                'amount' => 10000,
            ]);

        $this->assertDatabaseHas('savings', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'has_payed' => false,
        ]);

        $this->savingService->updateSaving(
            $saving,
            'Updated Test',
            25000
        );

        $this->assertDatabaseHas('savings', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Updated Test',
            'amount' => 25000,
            'has_payed' => false,
        ]);
    }

    public function test_that_saving_is_deleted(): void
    {
        $saving = Saving::factory()
            ->for($this->payPeriod)
            ->for($this->user)
            ->create([
                'name' => 'Test',
                'amount' => 10000,
            ]);

        $this->assertDatabaseHas('savings', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'has_payed' => false,
        ]);

        $this->savingService->deleteSaving($saving);

        $this->assertSoftDeleted('savings', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'has_payed' => false,
        ]);
    }
}
