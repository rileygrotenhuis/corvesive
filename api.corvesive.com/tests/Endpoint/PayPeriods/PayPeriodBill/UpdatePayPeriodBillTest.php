<?php

namespace Tests\Endpoint\PayPeriods\PayPeriodBill;

use App\Models\Bill;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdatePayPeriodBillTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected PayPeriod $payPeriod;

    protected Bill $bill;

    protected string $dueDate;

    protected array $payload = [];

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
            ->create([
                'amount' => 100000,
            ]);

        $this->dueDate = Carbon::today()->addDays(10)->toDateString();

        PayPeriodBill::factory()->create([
            'pay_period_id' => $this->payPeriod->id,
            'bill_id' => $this->bill->id,
            'amount' => 100000,
            'due_date' => Carbon::today()->toDateString(),
            'has_payed' => false,
        ]);

        $this->payload = [
            'amount' => 50000,
            'due_date' => $this->dueDate,
            'is_automatic' => false,
        ];
    }

    public function test_successful_pay_period_bill_update(): void
    {
        $this->submitRequest()
            ->assertStatus(200);

        $this->assertDatabaseHas('pay_period_bill', [
            'pay_period_id' => $this->payPeriod->id,
            'bill_id' => $this->bill->id,
            'amount' => 50000,
            'has_payed' => false,
            'due_date' => $this->dueDate,
            'is_automatic' => false,
        ]);
    }

    public function test_failed_pay_period_bill_update_with_invalid_amount_value(): void
    {
        $this->payload['amount'] = 'invalid';

        $this->submitRequest($this->bill)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_pay_period_bill_update_with_out_of_range_amount_value(): void
    {
        $this->payload['amount'] = -100;

        $this->submitRequest($this->bill)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }

    public function test_failed_pay_period_to_bill_link_with_invalid_due_date_field(): void
    {
        $this->payload['due_date'] = 'invalid';

        $this->submitRequest()
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('due_date');
    }

    public function test_failed_pay_period_to_bill_link_with_failed_authorization(): void
    {
        $newUser = User::factory()->create();
        $this->authenticatesUser($newUser);

        $this->bill = Bill::factory()
            ->for($newUser)
            ->create();

        $this->submitRequest()
            ->assertStatus(403);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->putJson(
            route('pay-periods.bills.update', [
                $this->payPeriod,
                $this->bill,
            ]),
            $this->payload
        );
    }
}
