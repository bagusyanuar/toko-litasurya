<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Services\Cashier\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends CustomController
{
    /** @var CustomerService $service */
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new CustomerService();
    }

    public function findAll()
    {
        $response = $this->service->findAll();
        return $this->toJSON($response);
    }
}
