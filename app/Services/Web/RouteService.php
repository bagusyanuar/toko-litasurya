<?php


namespace App\Services\Web;


use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Commons\Traits\Eloquent\Mutator;
use App\Domain\Web\Route\DTOFilter;
use App\Domain\Web\Route\DTOMutate;
use App\Models\Route;
use App\Usecase\Web\RouteInterface;

class RouteService implements RouteInterface
{
    use Finder, Mutator;

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        $filter->hydrateQuery();
        $filters = [
            self::filterQueryLikeBy($filter->getParam(), 'name', "%{$filter->getParam()}%"),
        ];
        $config = self::useBasicConfig('customer', ['details.customer'], $filter->getPage(), $filter->getPerPage(), $filters);
        return self::findFrom(
            Route::class,
            $config
        );
    }

    public function create(DTOMutate $dto): ServiceResponse
    {
        $config = [
            'type' => 'create',
            'template_message' => 'route',
            'child' => [
                'target' => 'details',
                'data' => 'stores',
                'type' => 'multiple',
                'foreign' => 'route_id'
            ]
        ];
        return self::mutateTo(Route::class, $dto, $config);
    }
}
