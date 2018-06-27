<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginPost;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('refresh')->except('login');
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param LoginPost $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginPost $request)
    {
        if (! $token = auth('api')->attempt($request->all())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => 'bearer ' . $token,
            'expires_in' => auth('api')->factory()->getTTL() * 60 // JWT time to live (in second)
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => '退出成功']);
    }
}
