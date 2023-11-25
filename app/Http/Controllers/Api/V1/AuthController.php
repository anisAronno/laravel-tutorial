<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * User login process
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if(!auth()->attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'Wrong Credential.']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Logged in successful',
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('token', expiresAt:now()->addDay())->plainTextToken
        ]);
    }

    /**
     * User logout process
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        if(request()->user()->tokens()->delete()) {
            return response()->json(['success' => true, 'message' => 'Logout successful']);
        }

        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    /**
     * User Profile Fetch
     *
     * @return JsonResponse
     */
    public function profile(): JsonResponse
    {
        if(request()->user()) {
            return response()->json([
                'success' => true,
                'message' => 'User retrieve successful',
                'user' => auth()->user()
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
