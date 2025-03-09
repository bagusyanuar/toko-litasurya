<?php


namespace App\Services\Web;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Domain\Web\Purchasing\DTOFilter;
use App\Models\Transaction;
use App\UseCase\Web\PurchasingUseCase;
use Illuminate\Database\Eloquent\Builder;

class PurchasingService implements PurchasingUseCase
{
    use Finder;

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        try {
            $filter->hydrateQuery();
            $query = Transaction::with(['user.sales', 'customer'])
                ->where('type', '=', 'sales')
                ->where('status', '=', 'pending')
                ->when($filter->getStore(), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->where('customer_id', '=', $filter->getStore());
                })->when($filter->getSales(), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->where('user_id', '=', $filter->getSales());
                })->when(($filter->getDateStart() && $filter->getDateEnd()), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->whereBetween('date', [$filter->getDateStart(), $filter->getDateEnd()]);
                });
            $totalRows = $query->count();
            $offset = ($filter->getPage() - 1) * $filter->getPerPage();
            $query
                ->offset($offset)
                ->limit($filter->getPerPage());
            $metaPagination = new MetaPagination($filter->getPage(), $filter->getPerPage(), $totalRows);
            $meta['pagination'] = $metaPagination->dehydrate();
            $data = $query->get();
            return ServiceResponse::statusOK('successfully get purchasing', $data, $meta);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        return self::getOneByID(Transaction::class, $id, ['relation' => ['carts.item', 'user.sales', 'customer']]);
    }
}
