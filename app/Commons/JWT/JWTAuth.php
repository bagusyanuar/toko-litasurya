<?php


namespace App\Commons\JWT;


use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth
{
    public static function encode(JWTClaims $jwtClaim)
    {
        $secretKey = config('jwt.secret');
        $issuer = config('jwt.issuer');
        $issuedAt = time();
        $payload = array(
            'iss' => $issuer,
            'iat' => $issuedAt,
            'sub' => $jwtClaim->getId(),
            'claims' => [
                'username' => $jwtClaim->getUsername(),
            ]
        );

        return JWT::encode($payload, $secretKey, 'HS256');
    }

    public static function decode($jwt)
    {
        try {
            $secretKey = config('jwt.secret');
            $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));
            return [
                'success' => true,
                'message' => 'success decode token',
                'data' => (array)$decoded->claims
            ];
        } catch (ExpiredException $e) {
            return [
                'success' => false,
                'message' => 'token expired',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'invalid token',
                'data' => null
            ];
        }
    }
}
