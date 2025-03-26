<?php


namespace App\Services\Web;


use App\Commons\Constant\Path;
use App\Commons\FileUpload\FileUpload;
use App\Commons\Response\MetaPagination;

use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Commons\Traits\Eloquent\Mutator;
use App\Domain\Web\Category\CategoryRequest;
use App\Domain\Web\Category\DTOCategoryFilter;
use App\Domain\Web\Category\DTOCategoryRequest;
use App\Domain\Web\Category\DTOMutateCategory;
use App\Helpers\Validator\ValidatorResponse;
use App\Models\Category;
use App\Services\CustomService;
use App\UseCase\Web\CategoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class CategoryService implements CategoryInterface
{
    use Finder, Mutator;

    /**
     * @inheritDoc
     */
    public function all(): ServiceResponse
    {
        return self::findFrom(Category::class, []);
    }

    /**
     * @inheritDoc
     */
    public function findAll(DTOCategoryFilter $filter): ServiceResponse
    {
        $filters = [
            self::filterQueryLikeBy($filter->getParam(), 'name', "%{$filter->getParam()}%")
        ];
        $order = [
            'key' => 'name',
            'type' => 'ASC'
        ];
        $config = self::useBasicConfig(
            'category',
            [],
            $filter->getPage(),
            $filter->getPerPage(),
            $filters,
            $order
        );
        return self::findFrom(
            Category::class,
            $config
        );
    }

    /**
     * @inheritDoc
     */
    public function findByID($id): ServiceResponse
    {
        return self::findOneFrom(Category::class, $id, ['template_message' => 'category']);
    }

    /**
     * @inheritDoc
     */
    public function create(DTOMutateCategory $dto): ServiceResponse
    {
        $config = [
            'type' => 'create',
            'upload' => [
                'key' => 'getFile',
                'column' => 'image',
                'path' => Path::CATEGORY_ASSET
            ],
            'template_message' => 'category'
        ];
        return self::mutateTo(Category::class, $dto, $config);
    }

    /**
     * @inheritDoc
     */
    public function update($id, DTOMutateCategory $dto): ServiceResponse
    {
        $config = [
            'type' => 'update',
            'key' => $id,
            'upload' => [
                'key' => 'getFile',
                'column' => 'image',
                'path' => Path::CATEGORY_ASSET
            ],
            'template_message' => 'category'
        ];
        return self::mutateTo(Category::class, $dto, $config);
    }

    public function delete($id): ServiceResponse
    {
        return self::removeFrom(Category::class, ['key' => $id]);
    }


}
