<?php

namespace Tests\Unit\Util;

use App\Util\PayPeriodMetricsUtil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PayPeriodMetricsUtilTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_pay_period_surplus_calculation(): void
    {
        $totalIncome = 250000;
        $totalSpent = 150000;
        $billsTotal = 150000;
        $budgetsTotal = 100000;

        $result = PayPeriodMetricsUtil::calculatePayPeriodSurplus(
            $totalIncome,
            $totalSpent,
            $billsTotal,
            $budgetsTotal
        );

        $this->assertEquals(collect([
            'current' => 100000,
            'projected' => 0,
        ]), $result);
    }

    public function test_successful_pay_period_surplus_calculation_with_leftover_surplus(): void
    {
        $totalIncome = 250000;
        $totalSpent = 150000;
        $billsTotal = 150000;
        $budgetsTotal = 50000;

        $result = PayPeriodMetricsUtil::calculatePayPeriodSurplus(
            $totalIncome,
            $totalSpent,
            $billsTotal,
            $budgetsTotal
        );

        $this->assertEquals(collect([
            'current' => 100000,
            'projected' => 50000,
        ]), $result);
    }
}
