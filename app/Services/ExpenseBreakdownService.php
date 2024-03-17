<?php

namespace App\Services;

use App\Models\User;

class ExpenseBreakdownService
{
    public function __construct(protected User $user)
    {
    }
}
