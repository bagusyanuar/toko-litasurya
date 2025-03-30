<?php


namespace App\Http\Controllers\Mobile;


use App\Domain\Mobile\Product\DTOFilter;
use App\Http\Controllers\CustomController;
use App\Services\Mobile\ProductService;

class ProductController extends CustomController
{
    /** @var ProductService $service */
    private $service;

    /** @var DTOFilter $dtoFilter */
    private $dtoFilter;

    public function __construct()
    {
        parent::__construct();
        $this->service = new ProductService();
        $this->dtoFilter = new DTOFilter();
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
