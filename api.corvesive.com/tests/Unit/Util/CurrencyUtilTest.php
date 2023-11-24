<?php

namespace Tests\Unit\Util;

use App\Util\CurrencyUtil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyUtilTest extends TestCase
{
    use RefreshDatabase;

    public function test_format_currency_values_with_whole_number(): void
    {
        $amount = 10000;
        $result = CurrencyUtil::formatCurrencyValues($amount);

        $this->assertEquals(collect([
            'raw' => 10000,
            'input' => '100.00',
            'pretty' => '$100.00',
        ]), $result);
    }

    public function test_format_currency_values_with_even_cents(): void
    {
        $amount = 12550;
        $result = CurrencyUtil::formatCurrencyValues($amount);

        $this->assertEquals(collect([
            'raw' => 12550,
            'input' => '125.50',
            'pretty' => '$125.50',
        ]), $result);
    }

    public function test_format_currency_values_with_odd_cents(): void
    {
        $amount = 12567;
        $result = CurrencyUtil::formatCurrencyValues($amount);

        $this->assertEquals(collect([
            'raw' => 12567,
            'input' => '125.67',
            'pretty' => '$125.67',
        ]), $result);
    }

    public function test_format_currency_values_with_null_amount(): void
    {
        $amount = null;
        $result = CurrencyUtil::formatCurrencyValues($amount);

        $this->assertEquals(collect([
            'raw' => 0,
            'input' => '0.00',
            'pretty' => '$0.00',
        ]), $result);
    }
}
