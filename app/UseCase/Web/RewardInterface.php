<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Reward\DTOFilterReward;
use App\Domain\Web\Reward\DTOMutateReward;

interface RewardInterface
{
    /**
     * @return ServiceResponse
     */
    public function all(): ServiceResponse;

    /**
     * @param DTOFilterReward $filter
     * @return ServiceResponse
     */
    public function findAll(DTOFilterReward $filter): ServiceResponse;

    /**
     * @param $id
     * @return ServiceResponse
     */
    public function findByID($id): ServiceResponse;

    /**
     * @param DTOMutateReward $dto
     * @return ServiceResponse
     */
    public function create(DTOMutateReward $dto): ServiceResponse;

    /**
     * @param $id
     * @param DTOMutateReward $dto
     * @return ServiceResponse
     */
    public function update($id, DTOMutateReward $dto): ServiceResponse;

    /**
     * @param $id
     * @return ServiceResponse
     */
    public function delete($id): ServiceResponse;
}
