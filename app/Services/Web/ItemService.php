<?php


namespace App\Services\Web;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Domain\Web\Item\DTOFilterItem;
use App\Domain\Web\Item\DTOMutateItem;
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
        $filters = [
            self::filterQueryLikeBy($filter->getParam(), 'name', "%{$filter->getParam()}%")
        ];
        $config = self::useBasicConfig('category', ['category'], $filter->getPage(), $filter->getPerPage(), $filters);
        return self::findFrom(
            Item::class,
            $config
        );
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
