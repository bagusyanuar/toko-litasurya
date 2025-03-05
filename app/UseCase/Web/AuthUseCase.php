<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Auth\DTOLogin;

interface AuthUseCase
{
    public function login(DTOLogin $dto): ServiceResponse;
}
