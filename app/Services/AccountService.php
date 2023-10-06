<?php

namespace App\Services;

use App\Models\User;

class AccountService
{
    public function updateAccount(
        User $user,
        string $firstName,
        string $lastName,
        string $email,
        string $phoneNumber
    ): User {
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->email = $email;
        $user->phone_number = $phoneNumber;
        $user->save();

        return $user;
    }
}
