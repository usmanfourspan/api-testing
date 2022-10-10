<?php

namespace App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        try {

            $user = User::create($request->validated());
            return response()->json([
                'message' => 'The user is created successfully.',
                'token' => $user->createToken(config('sanctum.token-key'))->plainTextToken
            ], Response::HTTP_CREATED);

        } catch (Exception $e) {
            report($e);
            return response()->json([
               'message' => __('messages.server-error'),
            ], Response::HTTP_BAD_REQUEST);
        }


    }

    public function login(LoginRequest $request)
    {
        try {

            $user = User::where('email', $request->email)->first();

            if (! $user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                   'message' => __('messages.auth.invalid-credentials')
                ], Response::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'message' => 'The user is logged in successfully.',
                'token' => $user->createToken(config('sanctum.token-key'))->plainTextToken
            ], Response::HTTP_OK);

        } catch (Exception $e) {
            report($e);
            return response()->json([
                'message' => __('messages.server-error'),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
