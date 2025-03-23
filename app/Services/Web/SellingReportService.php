<?php


namespace App\Services\Web;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Domain\Web\SellingReport\DTOFilter;
use App\Models\Transaction;
use App\Usecase\Web\SellingReportUseCase;
use Illuminate\Database\Eloquent\Builder;

class SellingReportService implements SellingReportUseCase
{

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        try {
            $filter->hydrateQuery();
            $query = Transaction::with(['user.sales', 'customer', 'carts.item'])
                ->where('status', '=', 'finish')
                ->when($filter->getInvoiceID(), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->where('reference_number', '=', $filter->getInvoiceID());
                })
//                ->when($filter->getType(), function ($q) use ($filter) {
//                    /** @var Builder $q */
//                    return $q->where('type', '=', $filter->getType());
//                })
                ->when(($filter->getDateStart() && $filter->getDateEnd()), function ($q) use ($filter) {
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
            return ServiceResponse::statusOK('successfully get selling report', $data, $meta);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
