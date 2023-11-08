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
        $result = PayPeriodMetricsUtil::calculatePayPeriodSurplus(
            184000,
            91900,
            91900,
            92000,
            14100
        );

        $this->assertEquals(collect([
            'current' => 14200,
            'projected' => 100,
        ]), $result);
    }
}
