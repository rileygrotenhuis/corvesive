<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidPasswordException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'errors' => [
                'password' => ['Invalid password'],
            ],
        ], 401);
    }
}
