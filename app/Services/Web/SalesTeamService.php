<?php


namespace App\Services\Web;


use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Commons\Traits\Eloquent\Mutator;
use App\Domain\Web\SalesTeam\DTOFilter;
use App\Domain\Web\SalesTeam\DTOMutate;
use App\Models\SalesTeam;
use App\Models\User;
use App\UseCase\Web\SalesTeamUseCase;

class SalesTeamService implements SalesTeamUseCase
{

    use Finder, Mutator;

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        $filter->hydrateQuery();
        $filters = [
            self::filterQueryLikeBy($filter->getParam(), 'username', "%{$filter->getParam()}%"),
            self::filterQueryIs('sales', 'role', 'sales')
        ];
        $config = self::useBasicConfig('sales team', ['sales'], $filter->getPage(), $filter->getPerPage(), $filters);
        return self::findFrom(
            User::class,
            $config
        );
    }

    public function findByID($id): ServiceResponse
    {
        // TODO: Implement findByID() method.
        return self::getOneByID(User::class, $id, [
            'relation' => ['sales']
        ]);
    }

    public function create(DTOMutate $dto): ServiceResponse
    {
        // TODO: Implement create() method.
        $config = [
            'type' => 'create',
            'template_message' => 'sales team',
            'child' => [
                'target' => 'sales',
                'data' => 'profile',
                'type' => 'single'
            ]
        ];
        return self::mutateTo(User::class, $dto, $config);
    }

    public function update($id, DTOMutate $dto): ServiceResponse
    {
        // TODO: Implement update() method.
        $dto->setMode('update');
        $config = [
            'type' => 'update',
            'key' => $id,
            'template_message' => 'sales team',
            'child' => [
                'target' => 'sales',
                'data' => 'profile',
                'type' => 'single'
            ]
        ];
        return self::mutateTo(User::class, $dto, $config);
    }

    public function delete($id): ServiceResponse
    {
        // TODO: Implement delete() method.
        return self::removeFrom(User::class, [
            'key' => $id,
            'children' => ['sales']
        ]);
    }

    public function all(DTOFilter $filter): ServiceResponse
    {
        $filter->hydrateQuery();
        $filters = [
            self::filterQueryLikeBy($filter->getParam(), 'name', "%{$filter->getParam()}%"),
        ];
        return self::findFrom(SalesTeam::class,[
            'filter' => $filters
        ]);
    }
}
