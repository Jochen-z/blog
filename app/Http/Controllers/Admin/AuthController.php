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
        $this->middleware('auth:api')->except('login');
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

        return $this->respondWithToken($token);
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

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => 'bearer ' . $token,
            'expires_in' => auth('api')->factory()->getTTL() * 60 // JWT time to live (in second)
        ]);
    }
}
