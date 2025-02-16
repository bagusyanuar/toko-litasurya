<?php


namespace App\Services\Web;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Item\DTOFilterItem;
use App\Models\Category;
use App\Models\Item;
use App\Usecase\Web\ItemInterface;
use Illuminate\Database\Query\Builder;

class ItemService implements ItemInterface
{

    /**
     * @inheritDoc
     */
    public function findAll(DTOFilterItem $filter): ServiceResponse
    {
        try {
            $query = Item::with([])
                ->when($filter->getParam(), function ($query) use ($filter) {
                    /** @var Builder $query */
                    return $query->where('name', 'LIKE', '%' . $filter->getParam() . '%');
                });
            $totalRows = $query->count();
            $page = $filter->getPage();
            $offset = ($page - 1) * $filter->getPerPage();
            $items = $query
                ->offset($offset)
                ->limit($filter->getPerPage())
                ->orderBy('created_at', 'DESC')
                ->get();
            //force to fetch previous page
            if ($page > 1 && count($items) <= 0) {
                $page = $page - 1;
                $offset = ($page - 1) * $filter->getPerPage();
                $categories = $query
                    ->offset($offset)
                    ->limit($filter->getPerPage())
                    ->orderBy('created_at', 'DESC')
                    ->get();
            }
            $metaPagination = new MetaPagination($page, $filter->getPerPage(), $totalRows);
            $meta = [
                'pagination' => $metaPagination->dehydrate()
            ];
            return ServiceResponse::statusOK(
                'successfully get data items',
                $categories,
                $meta
            );
        }catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
