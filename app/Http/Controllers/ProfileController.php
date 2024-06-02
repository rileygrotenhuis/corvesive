<?php

namespace App\Http\Controllers;

use Inertia\Response;

class ProfileController extends Controller
{
    public function edit(): Response
    {
        return inertia('Profile/Edit');
    }
}
