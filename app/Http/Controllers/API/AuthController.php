<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Login dan generate token JWT.
     */

    public function login(Request $request)
    {
        // Ambil kredensial dari request
        $credentials = $request->only('username', 'password');

        try {
            // Coba otentikasi dengan JWTAuth
            if (!$token = JWTAuth::attempt($credentials)) {
                Log::error('JWTAuth failed to generate token');
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'Username atau password salah. Silakan coba lagi.',
                ], 401);
            }


            // Kembalikan token jika berhasil

            return $this->respondWithToken($token);
            // return response()->json(compact('token'));
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Register user baru.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function getUserData()
    {
        try {
            if (!JWTAuth::getToken()) {
                return response()->json(['error' => 'Token not provided'], 401);
            }

            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 401);
            }
            // Mendapatkan token dari header dan memverifikasi pengguna
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            // Memuat data `sales` terkait menggunakan eager loading
            $userWithSales = $user->load('sales');

            // Mengembalikan data pengguna termasuk data sales
            return response()->json(['data' => $userWithSales]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * Logout user (invalidate token).
     */
    public function logout()
    {
        JWTAuth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Dapatkan user yang sedang login.
     */
    public function me()
    {
        return response()->json(JWTAuth::user());
    }

    /**
     * Refresh token JWT.
     */
    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    /**
     * Format respons token.
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}
