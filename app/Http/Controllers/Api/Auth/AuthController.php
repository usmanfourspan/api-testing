<?php

namespace App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {

        $user = User::create($request->validated());

        return response()->json([
            'message' => 'The user is created successfully.',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], Response::HTTP_CREATED);


    }

    public function login()
    {

    }
}
