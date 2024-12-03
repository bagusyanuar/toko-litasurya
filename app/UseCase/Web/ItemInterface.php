<?php


namespace App\Usecase\Web;


use App\Domain\ServiceResponse;
use App\Domain\ServiceResponseWithMetaPagination;
use App\Domain\Web\Item\ItemFilter;
use App\Domain\Web\Item\ItemRequest;
use App\Models\Item;

interface ItemInterface
{
    /**
     * @param ItemFilter $filter
     * @return ServiceResponseWithMetaPagination
     */
    public function getDataItems(ItemFilter $filter): ServiceResponseWithMetaPagination;

    /**
     * @param ItemRequest $itemRequest
     * @return ServiceResponse
     */
    public function createNewItem(ItemRequest $itemRequest): ServiceResponse;

    /**
     * @param $id
     * @return ServiceResponse
     */
    public function getItemByID($id): ServiceResponse;

    /**
     * @param Item $item
     * @param ItemRequest $itemRequest
     * @return ServiceResponse
     */
    public function updateItem(Item $item, ItemRequest $itemRequest): ServiceResponse;

    /**
     * @param Item $item
     * @return ServiceResponse
     */
    public function deleteItem(Item $item): ServiceResponse;
}
