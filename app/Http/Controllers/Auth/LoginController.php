<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class LoginController extends Controller
{
    /**
     * Login - Show Page.
     */
    public function index(): Response
    {
        return inertia('Auth/Login');
    }

    /**
     * Logs the user IN.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return to_route('dashboard');
    }

    /**
     * Logs the user OUT.
     */
    public function destroy(Request $request): RedirectResponse
    {
        auth()->guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('login');
    }
}
