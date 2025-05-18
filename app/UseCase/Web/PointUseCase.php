<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Point\DTOFilter;
use App\Domain\Web\Point\DTOMutate;

interface PointUseCase
{

    public function findAll(DTOFilter $filter): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(DTOMutate $dto): ServiceResponse;
    public function update($id, DTOMutate $dto): ServiceResponse;
    public function delete($id): ServiceResponse;
}
