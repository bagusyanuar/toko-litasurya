<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Category\DTOCategoryFilter;
use App\Domain\Web\Category\DTOMutateCategory;

interface CategoryInterface
{

    /**
     * @param DTOCategoryFilter $filter
     * @return ServiceResponse
     */
    public function findAll(DTOCategoryFilter $filter): ServiceResponse;

    /**
     * @param $id
     * @return ServiceResponse
     */
    public function findByID($id): ServiceResponse;

    /**
     * @param DTOMutateCategory $dto
     * @return ServiceResponse
     */
    public function create(DTOMutateCategory $dto): ServiceResponse;

    /**
     * @param $id
     * @return ServiceResponse
     */
    public function delete($id): ServiceResponse;

    /**
     * @param $id
     * @param DTOMutateCategory $dto
     * @return ServiceResponse
     */
    public function update($id, DTOMutateCategory $dto): ServiceResponse;
}
