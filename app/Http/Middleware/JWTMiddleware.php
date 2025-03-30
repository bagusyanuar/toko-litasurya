<?php

namespace App\Http\Middleware;

use App\Commons\JWT\JWTAuth;
use App\Commons\Response\APIResponse;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if (!$token) {
            return APIResponse::toJSONResponse(
                401,
                'token is required'
            );
        }

        $decodeResponse = JWTAuth::decode($token);
        if (!$decodeResponse['success']) {
            return APIResponse::toJSONResponse(
                401,
                $decodeResponse['message']
            );
        }
        $userData = $decodeResponse['data'];
        $user = User::with([])
            ->where('username', '=', $userData['username'])
            ->first();
        if (!$user) {
            return APIResponse::toJSONResponse(
                401,
                'Invalid User Account'
            );
        }
        auth()->setUser($user);
        return $next($request);
    }
}
