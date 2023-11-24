<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\UserResource;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function __construct(protected AccountService $accountService)
    {
    }

    public function me(): UserResource
    {
        return new UserResource(
            auth()
                ->user()
                ->load('payPeriod')
        );
    }

    public function update(UpdateAccountRequest $request): UserResource
    {
        if (auth()->user()->email !== $request->email) {
            $request->validate([
                'email' => 'required|email|unique:users,email|max:255',
            ]);
        }

        $user = $this->accountService->updateAccount(
            auth()->user(),
            $request->first_name,
            $request->last_name,
            $request->email,
            $request->phone_number,
            $request->pay_period_id
        );

        return new UserResource($user);
    }
}
