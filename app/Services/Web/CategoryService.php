<?php


namespace App\Services\Web;


use App\Domain\MetaPagination;
use App\Domain\ServiceResponse;
use App\Domain\ServiceResponseWithMetaPagination;
use App\Domain\Web\Category\CategoryFilter;
use App\Domain\Web\Category\CategoryRequest;
use App\Helpers\FileUpload\FileUpload;
use App\Helpers\FileUpload\FileUploadRequest;
use App\Helpers\Validator\ValidatorResponse;
use App\Models\Category;
use App\UseCase\Web\CategoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class CategoryService implements CategoryInterface
{
    private $targetPathImage = 'static/image/category';

    /**
     * @inheritDoc
     */
    public function getDataCategories(CategoryFilter $filter): ServiceResponseWithMetaPagination
    {
        // TODO: Implement getDataCategories() method.
        $response = new ServiceResponseWithMetaPagination();
        try {
            $query = Category::with([]);
            if ($filter->getParam() !== '') {
                $query->where('name', 'LIKE', '%' . $filter->getParam() . '%');
            }
            $offset = ($filter->getPage() - 1) * $filter->getPerPage();
            $totalRows = $query->count();
            $data = $query->offset($offset)
                ->limit($filter->getPerPage())
                ->get();

            $metaPagination = new MetaPagination($filter->getPage(), $filter->getPerPage(), $totalRows);
            $response->setMessage('successfully load data category')
                ->setData($data)
                ->setMeta($metaPagination);
        } catch (\Exception $e) {
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function createNewCategory(CategoryRequest $categoryRequest): ServiceResponse
    {
        // TODO: Implement createNewCategory() method.
        $response = new ServiceResponse();
        DB::beginTransaction();
        try {
            //validator
            $validator = $this->validate($categoryRequest);
            if (!$validator->isSuccess()) {
                return $response->setSuccess(false)
                    ->setCode(400)
                    ->setData($validator->getMessage())
                    ->setMessage('bad request');
            }
            $file = $categoryRequest->getFile();
            $imageName = null;
            if ($file) {
                $fileUploadService = new FileUpload();
                $fileUploadRequest = new FileUploadRequest($this->targetPathImage, $file);
                $fileUploadResponse = $fileUploadService->upload($fileUploadRequest);
                if (!$fileUploadResponse->isSuccess()) {
                    DB::rollBack();
                    return $response->setSuccess(false)
                        ->setCode(500)
                        ->setMessage($fileUploadResponse->getMessage());
                }
                $imageName = $fileUploadResponse->getFileName();
            }
            $data = [
                'name' => $categoryRequest->getName(),
                'image' => $imageName
            ];
            Category::create($data);
            $response->setMessage('successfully create new category')->setCode(201);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function deleteCategory($id): ServiceResponse
    {
        // TODO: Implement deleteCategory() method.
        $response = new ServiceResponse();
        try {
            Category::destroy($id);
            $response->setMessage('successfully create new category');
        } catch (\Exception $e) {
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function getCategoryByID($id): ServiceResponse
    {
        // TODO: Implement getCategoryByID() method.
        $response = new ServiceResponse();
        try {
            $data = Category::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$data) {
                return $response->setSuccess(false)
                    ->setCode(404)
                    ->setMessage('category not found');
            }
            $response->setMessage('successfully load data category')
                ->setData($data);
        } catch (\Exception $e) {
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function updateCategory(Category $category, CategoryRequest $categoryRequest): ServiceResponse
    {
        // TODO: Implement updateCategory() method.
        $response = new ServiceResponse();
        try {
            $file = $categoryRequest->getFile();
            $imageName = null;
            $data = [
                'name' => $categoryRequest->getName(),
            ];
            if ($categoryRequest->getFile()) {
                $fileUploadService = new FileUpload();
                $fileUploadRequest = new FileUploadRequest($this->targetPathImage, $file);
                $fileUploadResponse = $fileUploadService->upload($fileUploadRequest);

                if (!$fileUploadResponse->isSuccess()) {
                    return $response->setSuccess(false)
                        ->setCode(500)
                        ->setMessage($fileUploadResponse->getMessage());
                }
                $imageName = $fileUploadResponse->getFileName();
                $data['image'] = $imageName;
            }
            $category->update($data);
            $response->setMessage('successfully update data category')
                ->setData($category->toArray());
        } catch (\Exception $e) {
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function getDataCategoriesNoPagination(): ServiceResponse
    {
        // TODO: Implement getDataCategoriesNoPagination() method.
        $response = new ServiceResponse();
        try {
            $data = Category::with([])->get();
            $response->setMessage('successfully get data category')
                ->setData($data);
        } catch (\Exception $e) {
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    private function validate(CategoryRequest $categoryRequest): ValidatorResponse
    {
        $response = new ValidatorResponse(true, new MessageBag([]));
        $validator = Validator::make(
            ['name' => $categoryRequest->getName()],
            ['name' => 'required']
        );
        if ($validator->fails()) {
            return $response->setSuccess(false)
                ->setMessage($validator->errors());
        }
        return $response;
    }
}
