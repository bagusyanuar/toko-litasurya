<?php


namespace App\Services\Web;


use App\Commons\Constant\Path;
use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Commons\Traits\Eloquent\Mutator;
use App\Domain\Web\Item\DTOFilterItem;
use App\Domain\Web\Item\DTOFilterItemPrice;
use App\Domain\Web\Item\DTOMutateItem;
use App\Domain\Web\Item\DTOMutatePriceList;
use App\Domain\Web\Item\DTOMutatePrices;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemPrice;
use App\Services\CustomService;
use App\UseCase\Web\ItemInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

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
        $config = self::useBasicConfig('category', ['category', 'retail_price', 'prices'], $filter->getPage(), $filter->getPerPage(), $filters);
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
        return self::getOneByID(Item::class, $id, ['relation' => ['category', 'retail_price', 'prices']]);
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

    /**
     * @inheritDoc
     */
    public function mutatePriceList(DTOMutatePriceList $dto): ServiceResponse
    {
        try {
            $validator = $dto->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $dto->hydrate();
            $data = $dto->dehydrate();
            ItemPrice::updateOrCreate(
                [
                    'item_id' => $data['item_id'],
                    'unit' => $data['unit']
                ],
                $data
            );
            return ServiceResponse::created('successfully create price list');
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function findByPriceListUnit($plu): ServiceResponse
    {
        try {
            $priceItem = ItemPrice::with(['item'])
                ->where('price_list_unit', '=', $plu)
                ->first();
            if (!$priceItem) {
                return ServiceResponse::notFound('product not found');
            }
            return ServiceResponse::statusOK('successfully get product', $priceItem);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function findAllItemPrice(DTOFilterItemPrice $filter): ServiceResponse
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

    public function updatePriceList(DTOMutatePrices $dto): ServiceResponse
    {
        DB::beginTransaction();
        try {
            $dto->hydrate();
            $prices = $dto->getPrices();
            foreach ($prices as $price) {
                $dataPrice = [
                    'item_id' => $dto->getItemID(),
                    'price_list_unit' => $price['plu'],
                    'price' => $price['price'],
                    'unit' => $price['unit'],
                    'description' => '-'
                ];
                if ($price['id']) {
                    ItemPrice::updateOrCreate([
                        'id' => $price['id']
                    ], $dataPrice);
                } else {
                    if ($price['price'] > 0) {
                        ItemPrice::create($dataPrice);
                    }
                }
            }
            DB::commit();
            return ServiceResponse::statusOK('successfully update price list', $prices);
        } catch (\Exception $e) {
            DB::rollBack();
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
