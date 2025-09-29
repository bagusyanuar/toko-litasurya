<?php

namespace App\Http\Controllers\Cashier;

use App\Domain\Cashier\Product\ProductQuery;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\Mobile\CustomerController;
use App\Services\Cashier\ProductService;
use Illuminate\Http\Request;

class ProductController extends CustomController
{
    /** @var ProductService $service */
    private $service;

     public function __construct()
    {
        parent::__construct();
        $this->service = new ProductService();
    }

    public function findByPLU($plu)
    {
        $response = $this->service->findByPLU($plu);
        return $this->toJSON($response);
    }

    public function findAllPLU()
    {
        $query = $this->queryAll();
        $filter = new ProductQuery();
        $filter->hydrateQueryForm($query);
        $response = $this->service->findAllPLU($filter);
        return $this->toJSON($response);
    }
}
