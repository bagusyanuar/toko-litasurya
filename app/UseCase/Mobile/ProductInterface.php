<?php


namespace App\Usecase\Mobile;


use App\Commons\Response\ServiceResponse;
use App\Domain\Mobile\Product\DTOFilter;

interface ProductInterface
{
    public function findAll(DTOFilter $filter): ServiceResponse;
    public function findByID($id): ServiceResponse;
}
