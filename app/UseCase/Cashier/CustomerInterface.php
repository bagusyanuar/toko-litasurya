<?php

namespace App\UseCase\Cashier;

use App\Commons\Response\ServiceResponse;

interface CustomerInterface
{
    public function findAll(): ServiceResponse;
}
