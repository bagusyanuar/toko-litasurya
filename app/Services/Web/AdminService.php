<?php


namespace App\Services\Web;


use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Commons\Traits\Eloquent\Mutator;
use App\Domain\Web\Admin\DTOFilter;
use App\Domain\Web\Admin\DTOMutate;
use App\Models\User;
use App\Usecase\Web\AdminUseCase;

class AdminService implements AdminUseCase
{
    use Finder, Mutator;

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        $filter->hydrateQuery();
        $filters = [
            self::filterQueryLikeBy($filter->getParam(), 'username', "%{$filter->getParam()}%"),
            self::filterQueryIs('admin', 'role', 'admin')
        ];
        $config = self::useBasicConfig('admin', [], $filter->getPage(), $filter->getPerPage(), $filters);
        return self::findFrom(
            User::class,
            $config
        );
    }

    public function findByID($id): ServiceResponse
    {
        return self::getOneByID(User::class, $id);
    }

    public function create(DTOMutate $dto): ServiceResponse
    {
        $config = [
            'type' => 'create',
            'template_message' => 'admin',
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
            'template_message' => 'admin',
        ];
        return self::mutateTo(User::class, $dto, $config);
    }

    public function delete($id): ServiceResponse
    {
        // TODO: Implement delete() method.
        return self::removeFrom(User::class, [
            'key' => $id,
        ]);
    }
}
