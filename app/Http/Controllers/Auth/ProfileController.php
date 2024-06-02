<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Profile - Edit Page.
     */
    public function edit(): Response
    {
        return inertia('Profile/Edit');
    }

    /*
     * Updates a user's profile.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $request->user()->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
        ]);

        return to_route('profile.edit');
    }
}
