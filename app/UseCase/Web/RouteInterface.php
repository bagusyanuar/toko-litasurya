<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Route\DTOFilter;

interface RouteInterface
{
    public function findAll(DTOFilter $filter): ServiceResponse;
}
