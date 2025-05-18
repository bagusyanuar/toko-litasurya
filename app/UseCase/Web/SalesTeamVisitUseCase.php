<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\SalesTeamVisit\DTOFilter;

interface SalesTeamVisitUseCase
{
    public function findAll(DTOFilter $filter): ServiceResponse;
}
