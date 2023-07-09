<?php

namespace Tests\Unit\Services;

use App\Models\Bill;
use App\Models\PayPeriod;
use App\Models\User;
use App\Services\BillService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BillServiceTest extends TestCase
{
    use RefreshDatabase;

    protected BillService $billService;

    protected User $user;

    protected PayPeriod $payPeriod;

    public function setUp(): void
    {
        parent::setUp();
        $this->billService = new BillService();
        $this->user = User::factory()->create();
        $this->payPeriod = PayPeriod::factory()->for($this->user)->create();
    }

    public function test_that_bill_is_created(): void
    {
        $this->billService->createBill(
            $this->user,
            $this->payPeriod,
            'Test',
            10000
        );

        $this->assertDatabaseHas('bills', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'has_payed' => false,
        ]);
    }

    public function test_that_bill_is_updated(): void
    {
        $bill = Bill::factory()
            ->for($this->payPeriod)
            ->for($this->user)
            ->create([
                'name' => 'Test',
                'amount' => 10000,
            ]);

        $this->assertDatabaseHas('bills', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'has_payed' => false,
        ]);

        $this->billService->updateBill(
            $bill,
            'Updated Test',
            25000
        );

        $this->assertDatabaseHas('bills', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Updated Test',
            'amount' => 25000,
            'has_payed' => false,
        ]);
    }

    public function test_that_bill_is_deleted(): void
    {
        $bill = Bill::factory()
            ->for($this->payPeriod)
            ->for($this->user)
            ->create([
                'name' => 'Test',
                'amount' => 10000,
            ]);

        $this->assertDatabaseHas('bills', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'has_payed' => false,
        ]);

        $this->billService->deleteBill($bill);

        $this->assertSoftDeleted('bills', [
            'user_id' => $this->user->id,
            'pay_period_id' => $this->payPeriod->id,
            'name' => 'Test',
            'amount' => 10000,
            'has_payed' => false,
        ]);
    }
}
