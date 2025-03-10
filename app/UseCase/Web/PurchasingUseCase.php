<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Purchasing\DTOFilter;
use App\Domain\Web\Purchasing\DTOOrder;

interface PurchasingUseCase
{
    public function findAll(DTOFilter $filter): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function placeOrder($id, DTOOrder $dto): ServiceResponse;
}
