<?php

namespace App\Repositories;

use App\Models\User;

class DashboardRepository
{
    public function __construct(protected User $user)
    {
        //
    }
}
