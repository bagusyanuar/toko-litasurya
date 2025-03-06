<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Admin\DTOFilter;
use App\Domain\Web\Admin\DTOMutate;

interface AdminUseCase
{
    public function findAll(DTOFilter $filter): ServiceResponse;
    public function findByID($id): ServiceResponse;
    public function create(DTOMutate $dto): ServiceResponse;
    public function update($id, DTOMutate $dto): ServiceResponse;
    public function delete($id): ServiceResponse;
}
