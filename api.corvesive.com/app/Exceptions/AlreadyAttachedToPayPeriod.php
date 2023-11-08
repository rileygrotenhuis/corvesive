<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class AlreadyAttachedToPayPeriod extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'errors' => [
                'pay_period' => ['This has already been attached to this Pay Period'],
            ],
        ], 422);
    }
}
