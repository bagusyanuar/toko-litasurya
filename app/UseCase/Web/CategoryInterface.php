<?php


namespace App\UseCase\Web;


use App\Domain\ServiceResponse;
use App\Domain\ServiceResponseWithMetaPagination;
use App\Domain\Web\Category\CategoryFilter;
use App\Domain\Web\Category\CategoryRequest;
use App\Domain\Web\Category\DTOCategoryFilter;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{
    /**
     * @param DTOCategoryFilter $filter
     * @return ServiceResponseWithMetaPagination
     */
    public function findAll(DTOCategoryFilter $filter): ServiceResponseWithMetaPagination;
//    /**
//     * @param CategoryFilter $filter
//     * @return ServiceResponseWithMetaPagination
//     */
//    public function getDataCategories(CategoryFilter $filter): ServiceResponseWithMetaPagination;
//
//    /**
//     * @param CategoryRequest $categoryRequest
//     * @return ServiceResponse
//     */
//    public function createNewCategory(CategoryRequest $categoryRequest): ServiceResponse;
//
//    /**
//     * @param string $id
//     * @return ServiceResponse
//     */
//    public function deleteCategory($id): ServiceResponse;
//
//    /**
//     * @param $id
//     * @return ServiceResponse
//     */
//    public function getCategoryByID($id): ServiceResponse;
//
//    /**
//     * @param Category $category
//     * @param CategoryRequest $categoryRequest
//     * @return ServiceResponse
//     */
//    public function updateCategory(Category $category, CategoryRequest $categoryRequest): ServiceResponse;
//
//    /**
//     * @return ServiceResponse
//     */
//    public function getDataCategoriesNoPagination(): ServiceResponse;
}
