<?php


namespace App\Http\Controllers\Mobile;


use App\Domain\Mobile\Purchase\DTOFilter;
use App\Domain\Mobile\Purchase\DTOPurchase;
use App\Http\Controllers\CustomController;
use App\Services\Mobile\PurchaseService;

class PurchaseController extends CustomController
{
    /** @var PurchaseService $service */
    private $service;

    /** @var DTOPurchase $dtoPurchase */
    private $dtoPurchase;

    /** @var DTOFilter $dtoFilter */
    private $dtoFilter;

    public function __construct()
    {
        parent::__construct();
        $this->service = new PurchaseService();
        $this->dtoPurchase = new DTOPurchase();
        $this->dtoFilter = new DTOFilter();
    }

    public function create()
    {
        $jsonData = $this->requestFromJSON();
        $this->dtoPurchase->hydrateForm($jsonData);
        $response = $this->service->create($this->dtoPurchase);
        return $this->toJSON($response);
    }

    public function findAll()
    {
        $query = $this->queryAll();
        $this->dtoFilter->hydrateQueryForm($query);
        $response = $this->service->findAll($this->dtoFilter);
        return $this->toJSON($response);
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return $this->toJSON($response);
    }
}
