<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\SellingReturn\DTOFilter;

interface SellingReturnUseCase
{
    public function findAll(DTOFilter $filter): ServiceResponse;
    public function submitReturn($id): ServiceResponse;
}
