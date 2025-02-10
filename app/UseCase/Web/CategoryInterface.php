<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Category\DTOCategoryFilter;
use App\Domain\Web\Category\DTOCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{

    /**
     * @param DTOCategoryFilter $filter
     * @return ServiceResponse
     */
    public function findAll(DTOCategoryFilter $filter): ServiceResponse;

    /**
     * @param DTOCategoryRequest $dto
     * @return ServiceResponse
     */
    public function create(DTOCategoryRequest $dto): ServiceResponse;

    public function delete($id): ServiceResponse;
}
