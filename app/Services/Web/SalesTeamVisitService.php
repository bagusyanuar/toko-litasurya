<?php


namespace App\Services\Web;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Domain\Web\SalesTeamVisit\DTOFilter;
use App\Models\SalesTeamVisit;
use App\Usecase\Web\SalesTeamVisitUseCase;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class SalesTeamVisitService implements SalesTeamVisitUseCase
{

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        try {
            $filter->hydrateQuery();
            $query = SalesTeamVisit::with(['store', 'sales'])
                ->when($filter->getParam(), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->whereRelation('store', 'name', 'LIKE', "%{$filter->getParam()}%")
                        ->orWhereRelation('sales', 'name', 'LIKE', "%{$filter->getParam()}%");
                })->when(($filter->getDateStart() && $filter->getDateEnd()), function ($q) use ($filter) {
                    $startDate = Carbon::parse($filter->getDateStart())->startOfDay();
                    $endDate = Carbon::parse($filter->getDateEnd())->endOfDay();
                    /** @var Builder $q */
                    return $q->whereBetween('visited_at', [$startDate, $endDate]);
                })->orderBy('visited_at', 'DESC');
            $totalRows = $query->count();
            $offset = ($filter->getPage() - 1) * $filter->getPerPage();
            $query
                ->offset($offset)
                ->limit($filter->getPerPage());
            $metaPagination = new MetaPagination($filter->getPage(), $filter->getPerPage(), $totalRows);
            $meta['pagination'] = $metaPagination->dehydrate();
            $data = $query->get();
            return ServiceResponse::statusOK('successfully get sales team visits', $data, $meta);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
