<?php

namespace App\Services\Web;

use App\Commons\Response\MetaPagination;
use App\Domain\Web\PointRedemption\DTOFilterPointRedemption;
use App\Commons\Response\ServiceResponse;
use App\Domain\Web\PointRedemption\DTOMutatePointRedemption;
use App\UseCase\Web\PointRedemptionUseCase;
use App\Commons\Traits\Eloquent\Finder;
use App\Commons\Traits\Eloquent\Mutator;
use App\Models\Customer;
use App\Models\PointRedemption;
use App\Models\Reward;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PointRedemptionService implements PointRedemptionUseCase
{
    use Finder, Mutator;

    public function findAll(DTOFilterPointRedemption $filter): ServiceResponse
    {
        try {
            $filter->hydrateQuery();
            $query = PointRedemption::with(['customer', 'reward'])
                ->when($filter->getParam(), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->whereRelation('customer', 'name', 'LIKE', "%{$filter->getParam()}%");
                });
            //                ->when(($filter->getDateStart() && $filter->getDateEnd()), function ($q) use ($filter) {
            //                    /** @var Builder $q */
            //                    return $q->whereBetween('date', [$filter->getDateStart(), $filter->getDateEnd()]);
            //                });
            $totalRows = $query->count();
            $offset = ($filter->getPage() - 1) * $filter->getPerPage();
            $query
                ->offset($offset)
                ->limit($filter->getPerPage());
            $metaPagination = new MetaPagination($filter->getPage(), $filter->getPerPage(), $totalRows);
            $meta['pagination'] = $metaPagination->dehydrate();
            $data = $query->get();
            return ServiceResponse::statusOK('successfully get point redemption', $data, $meta);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function create(DTOMutatePointRedemption $dto): ServiceResponse
    {
        DB::beginTransaction();
        try {
            $dto->hydrate();
            $reward = Reward::with([])
                ->where('id', '=', $dto->getRewardId())
                ->first();
            if (!$reward) {
                return ServiceResponse::notFound('reward not found');
            }

            $customer = Customer::with([])
                ->where('id', '=', $dto->getcustomerId())
                ->first();
            if (!$customer) {
                return ServiceResponse::notFound('customer not found');
            }

            $pointReward = $reward->point;
            $currentPoint = $customer->point;

            if ($pointReward > $currentPoint) {
                return ServiceResponse::badRequest('point tidak mencukupi untuk melakukan penukaran hadiah ini.');
            }

            $newCustomerPoint = $currentPoint - $pointReward;
            $dataPointRedemption = [
                'date' => Carbon::now()->format('Y-m-d'),
                'customer_id' => $dto->getcustomerId(),
                'reward_id' => $dto->getRewardId(),
                'point_used' => $pointReward
            ];

            PointRedemption::create($dataPointRedemption);

            $customer->update([
                'point' => $newCustomerPoint
            ]);

            DB::commit();
            return ServiceResponse::statusOK('berhasil melakukan penukaran point');
        } catch (\Exception $e) {
            DB::rollBack();
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
