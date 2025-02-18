<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Item\DTOFilterItem;
use App\Domain\Web\Item\DTOMutateItem;

interface ItemInterface
{
    /**
     * @param DTOFilterItem $filter
     * @return ServiceResponse
     */
    public function findAll(DTOFilterItem $filter): ServiceResponse;

    /**
     * @param $id
     * @return ServiceResponse
     */
    public function findByID($id): ServiceResponse;

    /**
     * @param DTOMutateItem $dto
     * @return ServiceResponse
     */
    public function create(DTOMutateItem $dto): ServiceResponse;

}
