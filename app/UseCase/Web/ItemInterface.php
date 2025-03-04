<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Item\DTOFilterItem;
use App\Domain\Web\Item\DTOMutateItem;
use App\Domain\Web\Item\DTOMutatePriceList;

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

    /**
     * @param $id
     * @param DTOMutateItem $dto
     * @return ServiceResponse
     */
    public function update($id, DTOMutateItem $dto): ServiceResponse;

    /**
     * @param $id
     * @return ServiceResponse
     */
    public function delete($id): ServiceResponse;

    /**
     * @param DTOMutatePriceList $dto
     * @return ServiceResponse
     */
    public function mutatePriceList(DTOMutatePriceList $dto): ServiceResponse;

    public function findByPriceListUnit($plu): ServiceResponse;

}
