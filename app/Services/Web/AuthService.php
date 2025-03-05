<?php


namespace App\Services\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Auth\DTOLogin;
use App\Models\User;
use App\UseCase\Web\AuthUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthUseCase
{

    public function login(DTOLogin $dto): ServiceResponse
    {
        try {
            $validator = $dto->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $dto->hydrate();
            $user = User::with([])
                ->where('username', '=', $dto->getUsername())
                ->first();
            if (!$user) {
                return ServiceResponse::notFound('user not found');
            }

            $isPasswordValid = Hash::check($dto->getPassword(), $user->password);
            if (!$isPasswordValid) {
                return ServiceResponse::unauthorized('password did not match');
            }
            Auth::login($user);
            return ServiceResponse::statusOK('successfully login');
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
