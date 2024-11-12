<?php


namespace App\Services;


use App\Domain\ServiceResponse;
use App\Domain\Web\Category\CategoryFilter;
use App\Domain\Web\Category\CategoryRequest;
use App\Models\Category;
use App\UseCase\Web\CategoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CategoryService implements CategoryInterface
{

    /**
     * @inheritDoc
     */
    public function getDataCategories(CategoryFilter $filter): ServiceResponse
    {
        // TODO: Implement getDataCategories() method.
        $response = new ServiceResponse();
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
            $response->setMessage('successfully load data category')
                ->setData($data)
                ->setMeta([
                    'page' => $filter->getPage(),
                    'per_page' => $filter->getPerPage(),
                    'total_rows' => $totalRows
                ]);
        }catch (\Exception $e) {
            $response->setSuccess(false)
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
        try {
            $data = [
                'name' => $categoryRequest->getName(),
                'image' => $categoryRequest->getImage()
            ];
            Category::create($data);
            $response->setMessage('successfully create new category');
        }catch (\Exception $e) {
            $response->setSuccess(false)
                ->setMessage($e->getMessage());
        }
        return $response;
    }
}
