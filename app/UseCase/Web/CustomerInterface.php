<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Customer\DTOFilter;
use App\Domain\Web\Customer\DTOMutate;

interface CustomerInterface
{
    public function findAll(DTOFilter $filter): ServiceResponse;
    public function findAllPersonal(): ServiceResponse;
    public function findAllStore(): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(DTOMutate $dto): ServiceResponse;
}
