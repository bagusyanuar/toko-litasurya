<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {

        Log::info('masuk ke JWTMIDDLEWARE');

        if (!$token = JWTAuth::setRequest($request)->getToken()) {
            return response()->json(['message' => 'Token not provided'], 400);
        }

        try {
            $user = JWTAuth::authenticate($token);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token invalid'], 401);
        }

        return $next($request);
    }
}
