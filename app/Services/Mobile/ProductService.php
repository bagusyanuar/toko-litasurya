<?php


namespace App\Services\Mobile;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Domain\Mobile\Product\DTOFilter;
use App\Models\Item;
use App\Usecase\Mobile\ProductInterface;
use Illuminate\Database\Eloquent\Builder;

class ProductService implements ProductInterface
{

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        try {
            $filter->hydrateQuery();
            $query = Item::with([])
                ->when($filter->getParam(), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->where('name', 'LIKE', "%{$filter->getParam()}%");
                });
            $totalRows = $query->count();
            $offset = ($filter->getPage() - 1) * (int) $filter->getPerPage();
            $query
                ->offset($offset)
                ->limit($filter->getPerPage());
            $metaPagination = new MetaPagination($filter->getPage(), $filter->getPerPage(), $totalRows);
            $meta['pagination'] = $metaPagination->dehydrate();
            $data = $query->get();
            return ServiceResponse::statusOK('successfully get products', $data, $meta);
        } catch (\Throwable $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        try {
            $data = Item::with(['prices'])
                ->where('id', '=', $id)
                ->first();
            if (!$data) {
                return ServiceResponse::notFound('product not found');
            }
            return ServiceResponse::statusOK('successfully get product', $data);
        } catch (\Throwable $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
