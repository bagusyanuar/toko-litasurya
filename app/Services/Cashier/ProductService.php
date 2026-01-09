<?php

namespace App\Services\Cashier;

use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Domain\Cashier\Product\ProductQuery;
use App\Models\Item;
use App\Models\ItemPrice;
use App\UseCase\Cashier\ProductInterface;

class ProductService implements ProductInterface
{
    public function findByPLU($plu): ServiceResponse
    {
        try {
            $data = ItemPrice::with(['item'])
                ->where('price_list_unit', '=', $plu)
                ->first();
            if (!$data) {
                return ServiceResponse::notFound('product not found');
            }
            return ServiceResponse::statusOK('successfully get product', $data);
        } catch (\Throwable $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function findAllPLU(ProductQuery $filter): ServiceResponse
    {
        try {
            $filter->hydrateQuery();
            $page = $filter->getPage();
            $perPage = $filter->getPerPage();
            $query = ItemPrice::with(['item'])
                ->whereHas('item', function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->where('name', 'LIKE', "%{$filter->getParam()}%");
                });
            $totalRows = $query->count();
            $offset = ($page - 1) * $perPage;
            $query
                ->offset($offset)
                ->limit($perPage);
            $metaPagination = new MetaPagination($page, $perPage, $totalRows);
            $pagination = $metaPagination->dehydrate();
            $meta['pagination'] = $pagination;
            $data = $query->get();
            return ServiceResponse::statusOK(
                "successfully get item price",
                $data,
                $meta
            );
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
