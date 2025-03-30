<?php


namespace App\Usecase\Mobile;


use App\Commons\Response\ServiceResponse;
use App\Domain\Mobile\DTOLogin;

interface AuthInterface
{
    public function login(DTOLogin $dto): ServiceResponse;
}
