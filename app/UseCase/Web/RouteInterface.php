<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Route\DTOFilter;
use App\Domain\Web\Route\DTOMutate;

interface RouteInterface
{
    public function all(): ServiceResponse;
    public function findAll(DTOFilter $filter): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(DTOMutate $dto): ServiceResponse;
    public function update($id, DTOMutate $dto): ServiceResponse;
    public function delete($id): ServiceResponse;
}
