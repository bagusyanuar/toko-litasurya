<?php


namespace App\Services\Web;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Domain\Web\Item\DTOFilterItem;
use App\Domain\Web\Item\DTOMutateItem;
use App\Models\Category;
use App\Models\Item;
use App\Services\CustomService;
use App\Usecase\Web\ItemInterface;
use Illuminate\Database\Query\Builder;

class ItemService extends CustomService implements ItemInterface
{
    use Finder;

    /**
     * @inheritDoc
     */
    public function findAll(DTOFilterItem $filter): ServiceResponse
    {
        try {
            $filter->hydrateQuery();
            $filters = [
                [
                    'key' => $filter->getParam(),
                    'dispatcher' => function ($query) use ($filter) {
                        /** @var Builder $query */
                        return $query->where('name', 'LIKE', '%' . $filter->getParam() . '%');
                    }
                ],
            ];
            $items = [];
            $meta = null;
            return ServiceResponse::statusOK(
                'successfully get data items',
                $items,
                $meta
            );
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    /**
     * @inheritDoc
     */
    public function findByID($id): ServiceResponse
    {
        return self::getOneByID(Item::class, $id, 'item');
    }

    /**
     * @inheritDoc
     */
    public function create(DTOMutateItem $dto): ServiceResponse
    {
        // TODO: Implement create() method.
    }
}
