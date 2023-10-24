<?php

namespace Tests\Unit\Util;

use App\Util\DayOfMonthUtil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DayOfMonthUtilTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_day_of_month_conversion_with_st(): void
    {
        $dayOfMonth = 1;

        $result = DayOfMonthUtil::convertDayOfMonthToPrettyString($dayOfMonth);

        $this->assertEquals('1st', $result);
    }

    public function test_successful_day_of_month_conversion_with_nd(): void
    {
        $dayOfMonth = 22;

        $result = DayOfMonthUtil::convertDayOfMonthToPrettyString($dayOfMonth);

        $this->assertEquals('22nd', $result);
    }

    public function test_successful_day_of_month_conversion_with_rd(): void
    {
        $dayOfMonth = 3;

        $result = DayOfMonthUtil::convertDayOfMonthToPrettyString($dayOfMonth);

        $this->assertEquals('3rd', $result);
    }

    public function test_successful_day_of_month_conversion_with_td(): void
    {
        $dayOfMonth = 13;

        $result = DayOfMonthUtil::convertDayOfMonthToPrettyString($dayOfMonth);

        $this->assertEquals('13th', $result);
    }
}
