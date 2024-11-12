<?php


namespace App\UseCase\Web;


use App\Domain\ServiceResponse;
use App\Domain\Web\Category\CategoryFilter;
use App\Domain\Web\Category\CategoryRequest;
use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{
    /**
     * @param CategoryFilter $filter
     * @return ServiceResponse
     */
    public function getDataCategories(CategoryFilter $filter): ServiceResponse;

    /**
     * @param CategoryRequest $categoryRequest
     * @return ServiceResponse
     */
    public function createNewCategory(CategoryRequest $categoryRequest): ServiceResponse;
}
