<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class RegisterController extends Controller
{
    /**
     * Register - Show Page.
     */
    public function index(): Response
    {
        return inertia('Auth/Register');
    }

    /**
     * Registers a new user.
     */
    public function store(RegistrationRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        auth()->login($user);

        return to_route('dashboard');
    }
}
