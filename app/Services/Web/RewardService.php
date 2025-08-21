<?php


namespace App\Services\Web;


use App\Commons\Constant\Path;
use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Commons\Traits\Eloquent\Mutator;
use App\Domain\Web\Reward\DTOFilterReward;
use App\Domain\Web\Reward\DTOMutateReward;
use App\Models\Reward;
use App\UseCase\Web\RewardInterface;

class RewardService implements RewardInterface
{
    use Finder, Mutator;
    /**
     * @inheritDoc
     */
    public function all(): ServiceResponse
    {
        return self::findFrom(Reward::class, []);
    }

    /**
     * @inheritDoc
     */
    public function findAll(DTOFilterReward $filter): ServiceResponse
    {
        $filters = [
            self::filterQueryLikeBy($filter->getParam(), 'name', "%{$filter->getParam()}%")
        ];
        $config = self::useBasicConfig('reward', [], $filter->getPage(), $filter->getPerPage(), $filters);
        return self::findFrom(
            Reward::class,
            $config
        );
    }

    /**
     * @inheritDoc
     */
    public function findByID($id): ServiceResponse
    {
        // TODO: Implement findByID() method.
        return self::getOneByID(Reward::class, $id, []);
    }

    /**
     * @inheritDoc
     */
    public function create(DTOMutateReward $dto): ServiceResponse
    {
        // TODO: Implement create() method.
        $config = [
            'type' => 'create',
            'upload' => [
                'key' => 'getImage',
                'column' => 'image',
                'path' => Path::REWARD_ASSET
            ],
            'template_message' => 'reward',
        ];
        return self::mutateTo(Reward::class, $dto, $config);
    }

    /**
     * @inheritDoc
     */
    public function update($id, DTOMutateReward $dto): ServiceResponse
    {
        // TODO: Implement update() method.
        $config = [
            'type' => 'update',
            'key' => $id,
            'upload' => [
                'key' => 'getImage',
                'column' => 'image',
                'path' => Path::REWARD_ASSET
            ],
            'template_message' => 'reward',
        ];
        return self::mutateTo(Reward::class, $dto, $config);
    }

    /**
     * @inheritDoc
     */
    public function delete($id): ServiceResponse
    {
        // TODO: Implement delete() method.
        return self::removeFrom(Reward::class, [
            'key' => $id,
        ]);
    }
}
