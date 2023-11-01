<?php

namespace App\Http\v1\Controllers;

use App\Http\v1\Requests\LoginRequest;
use App\Http\v1\Requests\RegistrationRequest;
use App\Http\v1\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request): JsonResponse
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = bcrypt($request->password);
        $user->save();

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if ($user === null) {
            return response()->json([
                'errors' => [
                    'email' => ['User does not exist with that email'],
                ],
            ], 401);
        }

        if (! Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => [
                    'password' => ['Invalid password'],
                ],
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'logged out',
        ], 204);
    }
}