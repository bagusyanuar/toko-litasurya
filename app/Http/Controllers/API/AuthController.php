<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * Login dan generate token JWT.
     */
    public function login(Request $request)
    {
        // Ambil kredensial dari request
        $credentials = $request->only('username', 'password');

        // Coba otentikasi dengan JWTAuth
        if (!$token = JWTAuth::attempt($credentials)) {
            // Jika gagal, kembalikan error 401 dengan pesan JSON yang lebih jelas
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Username atau password salah. Silakan coba lagi.',
            ], 401);
        }

        // Jika berhasil, kembalikan token
        return $this->respondWithToken($token);
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
            // Mendapatkan token dari header dan memverifikasi pengguna
            $user = JWTAuth::parseToken()->authenticate();

            // Memuat data `sales` terkait menggunakan eager loading
            $userWithSales = $user->load('sales');

            // Mengembalikan data pengguna termasuk data sales
            return response()->json(['data' => $userWithSales]);
        } catch (Exception $e) {
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
