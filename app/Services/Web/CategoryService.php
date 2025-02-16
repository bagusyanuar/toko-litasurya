<?php


namespace App\Services\Web;


use App\Commons\Constant\Path;
use App\Commons\FileUpload\FileUpload;
use App\Commons\Response\MetaPagination;

use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Category\CategoryRequest;
use App\Domain\Web\Category\DTOCategoryFilter;
use App\Domain\Web\Category\DTOCategoryRequest;
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
    /**
     * @inheritDoc
     */
    public function findAll(DTOCategoryFilter $filter): ServiceResponse
    {
        // TODO: Implement findAll() method.
        try {
            $filters = [
                [
                    'key' => $filter->getParam(),
                    'dispatcher' => function ($query) use ($filter) {
                        /** @var Builder $query */
                        return $query->where('name', 'LIKE', '%' . $filter->getParam() . '%');
                    }
                ],
            ];
            $categories = $this->queryFrom(Category::class)
                ->filters($filters)
                ->paginate($filter->getPage(), $filter->getPerPage());
            $totalRows = $this->queryRows;
            dd($categories, $totalRows);
            $query = Category::with([])
                ->when($filter->getParam(), function ($query) use ($filter) {
                    /** @var Builder $query */
                    return $query->where('name', 'LIKE', '%' . $filter->getParam() . '%');
                });
            $totalRows = $query->count();
            $page = $filter->getPage();
            $offset = ($page - 1) * $filter->getPerPage();
            $categories = $query
                ->offset($offset)
                ->limit($filter->getPerPage())
                ->orderBy('created_at', 'DESC')
                ->get();
            //force to fetch previous page
            if ($page > 1 && count($categories) <= 0) {
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
                'successfully get data categories',
                $categories,
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
        // TODO: Implement findByID() method.
        try {
            $category = Category::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$category) {
                return ServiceResponse::notFound('category not found');
            }
            return ServiceResponse::statusOK('successfully get category', $category);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    /**
     * @inheritDoc
     */
    public function create(DTOCategoryRequest $dto): ServiceResponse
    {
        // TODO: Implement create() method.
        try {
            $validator = $dto->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $dto->hydrate();
            $dataCategory = [
                'name' => $dto->getName()
            ];
            if ($dto->getFile()) {
                $file = $dto->getFile();
                $fileUploadService = new FileUpload($file, Path::CATEGORY_ASSET);
                $fileUploadResponse = $fileUploadService->upload();
                if (!$fileUploadResponse->isSuccess()) {
                    return ServiceResponse::internalServerError('failed to upload');
                }
                $dataCategory['image'] = $fileUploadResponse->getFileName();
            }
            Category::create($dataCategory);
            return ServiceResponse::created('successfully create new category');
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
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

            $category = Category::with([])
                ->where('id', '=', $id)
                ->first();
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
