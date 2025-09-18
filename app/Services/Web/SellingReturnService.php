<?php


namespace App\Services\Web;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Domain\Web\SellingReturn\DTOFilter;
use App\Models\TransactionReturn;
use App\UseCase\Web\SellingReturnUseCase;
use Illuminate\Database\Eloquent\Builder;

class SellingReturnService implements SellingReturnUseCase
{

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        // TODO: Implement findAll() method.
        try {
            $filter->hydrateQuery();
            $query = $this->generateQuery();
            $totalRows = $query->count();
            $total = $query->sum('total');
            $offset = ($filter->getPage() - 1) * $filter->getPerPage();
            $query
                ->offset($offset)
                ->limit($filter->getPerPage());
            $metaPagination = new MetaPagination($filter->getPage(), $filter->getPerPage(), $totalRows);
            $meta['pagination'] = $metaPagination->dehydrate();
            $data = $query->get();
            return ServiceResponse::statusOK('successfully get selling return report', [
                'data' => $data,
                'total' => (int)$total
            ], $meta);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    private function generateQuery(): Builder
    {
        return TransactionReturn::with(['user.sales', 'customer', 'details.item'])
            ->where('status', '=', 'pending')
            ->orderBy('date', 'ASC');
    }

    public function submitReturn($id): ServiceResponse
    {
        // TODO: Implement submitReturn() method.
        try {
            $transaction = TransactionReturn::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$transaction) {
                return ServiceResponse::notFound('transaction not found');
            }
            $transaction->update(['status' => 'finish']);
            return ServiceResponse::statusOK('successfully update selling return');
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
