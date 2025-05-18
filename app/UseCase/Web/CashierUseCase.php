<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Cashier\DTOSubmit;

interface CashierUseCase
{
    public function submitOrder(DTOSubmit $dto): ServiceResponse;
}
