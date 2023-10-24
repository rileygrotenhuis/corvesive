<?php

namespace App\Util;

class DayOfMonthUtil
{
    public static function convertDayOfMonthToPrettyString(int $dayOfMonth): string
    {
        if ($dayOfMonth < 1 || $dayOfMonth > 31) {
            return 'Invalid day';
        }

        if ($dayOfMonth >= 11 && $dayOfMonth <= 13) {
            $suffix = 'th';
        } else {
            switch ($dayOfMonth % 10) {
                case 1:
                    $suffix = 'st';
                    break;
                case 2:
                    $suffix = 'nd';
                    break;
                case 3:
                    $suffix = 'rd';
                    break;
                default:
                    $suffix = 'th';
                    break;
            }
        }

        return $dayOfMonth.$suffix;
    }
}
