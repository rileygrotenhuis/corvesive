<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\UserResource;
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
}
