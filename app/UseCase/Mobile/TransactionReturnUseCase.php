<?php


namespace App\UseCase\Mobile;


use App\Commons\Response\ServiceResponse;
use App\Domain\Mobile\TransactionReturn\DTOTransactionReturn;

interface TransactionReturnUseCase
{
    public function create(DTOTransactionReturn $dto): ServiceResponse;
}
