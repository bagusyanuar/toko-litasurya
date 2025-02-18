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

class CategoryService extends CustomService implements CategoryInterface
{
    use Finder, Mutator;

    /**
     * @inheritDoc
     */
    public function findAll(DTOCategoryFilter $filter): ServiceResponse
    {
        $filters = [
            self::filterQueryLikeBy($filter->getParam(), 'name', "%{$filter->getParam()}%")
        ];
        $config = self::useBasicConfig('category', $filter->getPage(), $filter->getPerPage(), $filters);
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
            ]
        ];
        return self::mutateTo(Category::class, $dto, $config);
    }

    public function delete($id): ServiceResponse
    {
        try {
            Category::destroy($id);
            return ServiceResponse::statusOK('successfully delete category');
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    /**
     * @inheritDoc
     */
    public function update($id, DTOCategoryRequest $dto): ServiceResponse
    {
        // TODO: Implement update() method.
        try {
            $validator = $dto->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $dto->hydrate();
            $dataCategory = [
                'name' => $dto->getName()
            ];
            $category = Category::find($id);
            if (!$category) {
                return ServiceResponse::notFound('category not found');
            }
            if ($dto->getFile()) {
                $file = $dto->getFile();
                $fileUploadService = new FileUpload($file, Path::CATEGORY_ASSET);
                $fileUploadResponse = $fileUploadService->upload();
                if (!$fileUploadResponse->isSuccess()) {
                    return ServiceResponse::internalServerError('failed to upload');
                }
                $dataCategory['image'] = $fileUploadResponse->getFileName();
            }

            $category->update($dataCategory);
            return ServiceResponse::created('successfully update new category');
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
