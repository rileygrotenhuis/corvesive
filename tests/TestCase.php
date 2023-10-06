<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function authenticatesUser(User $user): void
    {
        $user->createToken('test-token')->plainTextToken;

        Sanctum::actingAs($user, ['*']);
    }
}
