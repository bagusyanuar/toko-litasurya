<?php


namespace App\Services\Web;


use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Commons\Traits\Eloquent\Mutator;
use App\Domain\Web\Point\DTOFilter;
use App\Domain\Web\Point\DTOMutate;
use App\Models\PointSetting;
use App\Usecase\Web\PointUseCase;

class PointService implements PointUseCase
{
    use Finder, Mutator;

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        $filter->hydrateQuery();
        $config = self::useBasicConfig('reward', [], $filter->getPage(), $filter->getPerPage(), []);
        return self::findFrom(
            PointSetting::class,
            $config
        );
    }

    public function findByID($id): ServiceResponse
    {
        return self::getOneByID(PointSetting::class, $id, []);
    }

    public function create(DTOMutate $dto): ServiceResponse
    {
        $config = [
            'type' => 'create',
            'template_message' => 'point',
        ];
        return self::mutateTo(PointSetting::class, $dto, $config);
    }

    public function update($id, DTOMutate $dto): ServiceResponse
    {
        $config = [
            'type' => 'update',
            'key' => $id,
            'template_message' => 'point',
        ];
        return self::mutateTo(PointSetting::class, $dto, $config);
    }

    public function delete($id): ServiceResponse
    {
        return self::removeFrom(PointSetting::class, [
            'key' => $id,
        ]);
    }
}
