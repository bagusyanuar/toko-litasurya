<?php

namespace App\Services\Cashier;

use App\Commons\Response\ServiceResponse;
use App\Models\Customer;
use App\UseCase\Cashier\CustomerInterface;

class CustomerService implements CustomerInterface
{
    public function findAll(): ServiceResponse
    {
        try {
            $data = Customer::with([])
                ->get();
            return ServiceResponse::statusOK('successfully get customers', $data);
        } catch (\Throwable $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
