<?php

namespace App\Http\Controllers\Cashier;

use App\Domain\Cashier\Order\OrderSchema;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Services\Cashier\OrderService;
use Illuminate\Http\Request;

class OrderController extends CustomController
{
    /** @var OrderService $service */
    private $service;

     public function __construct()
    {
        parent::__construct();
        $this->service = new OrderService();
    }

    public function order()
    {
        $jsonData = $this->requestFromJSON();
        $schema = new OrderSchema();
        $schema->hydrateForm($jsonData);
        $response = $this->service->placeOrder($schema);
        return $this->toJSON($response);
    }

    public function findByID($id)
    {

        $response = $this->service->findByID($id);
        return $this->toJSON($response);
    }
}
