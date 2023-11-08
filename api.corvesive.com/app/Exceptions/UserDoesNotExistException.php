<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserDoesNotExistException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'errors' => [
                'email' => ['User does not exist with that email'],
            ],
        ], 401);
    }
}
