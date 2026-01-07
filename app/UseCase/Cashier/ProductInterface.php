<?php

namespace App\UseCase\Cashier;

use App\Commons\Response\ServiceResponse;
use App\Domain\Cashier\Product\ProductQuery;

interface ProductInterface
{
    public function findByPLU($plu): ServiceResponse;
    public function findAllPLU(ProductQuery $filter): ServiceResponse;
}
