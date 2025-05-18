<?php


namespace App\Http\Controllers\Mobile;


use App\Domain\Mobile\TransactionReturn\DTOTransactionReturn;
use App\Http\Controllers\CustomController;
use App\Services\Mobile\TransactionReturnService;

class TransactionReturnController extends CustomController
{
    /** @var TransactionReturnService $service */
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new TransactionReturnService();
    }

    public function create()
    {
        $body = $this->requestFromJSON();
        $dto = new DTOTransactionReturn();
        $dto->hydrateForm($body);
        $response = $this->service->create($dto);
        return $this->toJSON($response);
    }
}
