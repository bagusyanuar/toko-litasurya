<?php


namespace App\UseCase\Mobile;


use App\Commons\Response\ServiceResponse;
use App\Domain\Mobile\Purchase\DTOFilter;
use App\Domain\Mobile\Purchase\DTOPurchase;

interface PurchaseInterface
{
    public function findAll(DTOFilter $filter): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(DTOPurchase $dto): ServiceResponse;
}
