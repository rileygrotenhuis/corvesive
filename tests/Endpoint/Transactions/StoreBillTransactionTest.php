<?php

namespace Tests\Endpoint\Transactions;

use App\Models\Bill;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StoreBillTransactionTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Bill $bill;

    protected PayPeriodBill $payPeriodBill;

    protected array $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->authenticatesUser($this->user);

        $this->payPeriod = PayPeriod::factory()
            ->for($this->user)
            ->create();

        $this->bill = Bill::factory()
            ->for($this->user)
            ->create();

        $this->payPeriodBill::factory()
            ->for($this->payperiod)
            ->for($this->bill)
            ->create();

        $this->payload = [];
    }

    protected function submitRequest(Bill $bill): TestResponse
    {
        return $this->postJson(
            route('pay-periods.bills.transaction', [
                $this->payPeriod,
                $bill,
            ]),
            $this->payload
        );
    }
}
