<?php


namespace App\UseCase\Web;


use App\Domain\ServiceResponse;
use App\Domain\ServiceResponseWithMetaPagination;
use App\Domain\Web\Category\CategoryFilter;
use App\Domain\Web\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{
    /**
     * @param CategoryFilter $filter
     * @return ServiceResponse
     */
    public function getDataCategories(CategoryFilter $filter): ServiceResponseWithMetaPagination;

    /**
     * @param CategoryRequest $categoryRequest
     * @return ServiceResponse
     */
    public function createNewCategory(CategoryRequest $categoryRequest): ServiceResponse;

    /**
     * @param string $id
     * @return ServiceResponse
     */
    public function deleteCategory($id): ServiceResponse;

    /**
     * @param $id
     * @return ServiceResponse
     */
    public function getCategoryByID($id): ServiceResponse;

    /**
     * @param Category $category
     * @param CategoryRequest $categoryRequest
     * @return ServiceResponse
     */
    public function updateCategory(Category $category, CategoryRequest $categoryRequest): ServiceResponse;
}
