<?php

namespace App\Http\v1\Controllers;

use App\Http\v1\Requests\UpdateAccountRequest;
use App\Http\v1\Resources\UserResource;
use App\Models\User;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }

    public function update(UpdateAccountRequest $request): UserResource
    {
        if (auth()->user()->email !== $request->email) {
            $request->validate([
                'email' => 'required|email|unique:users,email|max:255',
            ]);
        }

        $user = (new AccountService())
            ->updateAccount(
                auth()->user(),
                $request->first_name,
                $request->last_name,
                $request->email,
                $request->phone_number
            );

        return new UserResource($user);
    }

    public function onboard(): UserResource
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->is_onboarding = 0;
        $user->save();

        return new UserResource(auth()->user());
    }
}
