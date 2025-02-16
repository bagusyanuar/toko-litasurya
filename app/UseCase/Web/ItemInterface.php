<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Item\DTOFilterItem;

interface ItemInterface
{
    /**
     * @param DTOFilterItem $filter
     * @return ServiceResponse
     */
    public function findAll(DTOFilterItem $filter): ServiceResponse;
}
