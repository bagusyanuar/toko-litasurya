<?php


namespace App\Services\Web;


use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Commons\Traits\Eloquent\Mutator;
use App\Domain\Web\Customer\DTOFilter;
use App\Domain\Web\Customer\DTOMutate;
use App\Models\Customer;
use App\Usecase\Web\CustomerInterface;

class CustomerService implements CustomerInterface
{
    use Finder, Mutator;

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        $filter->hydrateQuery();
        $filters = [
            self::filterQueryLikeBy($filter->getParam(), 'name', "%{$filter->getParam()}%"),
            self::filterQueryIs($filter->getType(), 'type', $filter->getType())
        ];
        $config = self::useBasicConfig('customer', [], $filter->getPage(), $filter->getPerPage(), $filters);
        return self::findFrom(
            Customer::class,
            $config
        );
    }

    public function findAllPersonal(): ServiceResponse
    {
        // TODO: Implement findAllPersonal() method.
    }

    public function findAllStore(): ServiceResponse
    {
        // TODO: Implement findAllStore() method.
    }

    public function findByID($id): ServiceResponse
    {
        return self::getOneByID(Customer::class, $id);
    }

    public function create(DTOMutate $dto): ServiceResponse
    {
        $config = [
            'type' => 'create',
            'template_message' => 'customer',
        ];
        return self::mutateTo(Customer::class, $dto, $config);
    }

    public function update($id, DTOMutate $dto): ServiceResponse
    {
        // TODO: Implement update() method.
        $config = [
            'type' => 'update',
            'key' => $id,
            'template_message' => 'customer',
        ];
        return self::mutateTo(Customer::class, $dto, $config);
    }

    public function delete($id): ServiceResponse
    {
        return self::removeFrom(Customer::class, [
            'key' => $id,
        ]);
    }
}
