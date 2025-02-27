<?php


namespace App\Services\Web;


use App\Commons\Constant\Path;
use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Commons\Traits\Eloquent\Mutator;
use App\Domain\Web\Item\DTOFilterItem;
use App\Domain\Web\Item\DTOMutateItem;
use App\Models\Category;
use App\Models\Item;
use App\Services\CustomService;
use App\Usecase\Web\ItemInterface;
use Illuminate\Database\Query\Builder;

class ItemService extends CustomService implements ItemInterface
{
    use Finder, Mutator;

    /**
     * @inheritDoc
     */
    public function findAll(DTOFilterItem $filter): ServiceResponse
    {
        $filters = [
            self::filterQueryLikeBy($filter->getParam(), 'name', "%{$filter->getParam()}%")
        ];
        $config = self::useBasicConfig('category', ['category', 'retail_price'], $filter->getPage(), $filter->getPerPage(), $filters);
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
        return self::getOneByID(Item::class, $id, ['relation' => ['category', 'retail_price']]);
    }

    /**
     * @inheritDoc
     */
    public function create(DTOMutateItem $dto): ServiceResponse
    {
        $config = [
            'type' => 'create',
            'upload' => [
                'key' => 'getFile',
                'column' => 'image',
                'path' => Path::ITEM_ASSET
            ],
            'template_message' => 'item',
            'child' => [
                'target' => 'prices',
                'data' => 'price',
                'type' => 'single'
            ]
        ];
        return self::mutateTo(Item::class, $dto, $config);
    }

    /**
     * @inheritDoc
     */
    public function update($id, DTOMutateItem $dto): ServiceResponse
    {
        $config = [
            'type' => 'update',
            'key' => $id,
            'upload' => [
                'key' => 'getFile',
                'column' => 'image',
                'path' => Path::ITEM_ASSET
            ],
            'template_message' => 'category',
            'child' => [
                'target' => 'retail_price',
                'data' => 'price',
                'type' => 'single'
            ]
        ];
        return self::mutateTo(Item::class, $dto, $config);
    }

    /**
     * @inheritDoc
     */
    public function delete($id): ServiceResponse
    {
        return self::removeFrom(Item::class, [
            'key' => $id,
            'children' => ['prices']
        ]);
    }
}
