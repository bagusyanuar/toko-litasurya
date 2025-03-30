<?php


namespace App\Services\Mobile;


use App\Commons\JWT\JWTAuth;
use App\Commons\JWT\JWTClaims;
use App\Commons\Response\ServiceResponse;
use App\Domain\Mobile\DTOLogin;
use App\Models\User;
use App\Usecase\Mobile\AuthInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthInterface
{

    public function login(DTOLogin $dto): ServiceResponse
    {
        try {
            $dto->hydrate();
            $username = $dto->getUsername();
            $password = $dto->getPassword();
            $account = User::with([])
                ->where('username', '=', $username)
                ->where('role', '=', 'sales')
                ->first();
            if (!$account) {
                return ServiceResponse::notFound('user not found!');
            }

            $isPasswordValid = Hash::check($password, $account->password);
            if (!$isPasswordValid) {
                return ServiceResponse::unauthorized('password did not match');
            }

            $jwtClaim = new JWTClaims(
                $account->id,
                $account->username
            );
            $token = JWTAuth::encode($jwtClaim);
            $response = [
                'access_token' => $token,
            ];
            return ServiceResponse::statusOK("successfully login", $response);
        } catch (\Throwable $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
