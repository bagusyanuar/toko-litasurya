<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Route\DTOFilter;
use App\Domain\Web\Route\DTOMutate;

interface RouteInterface
{
    public function findAll(DTOFilter $filter): ServiceResponse;
    public function create(DTOMutate $dto): ServiceResponse;
}
