<?php


namespace App\Services\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Schedule\DTOMutate;
use App\Models\SalesTeamSchedule;
use App\Usecase\Web\ScheduleUseCase;

class ScheduleService implements ScheduleUseCase
{

    public function findBySalesID($id): ServiceResponse
    {
        try {
            $data = SalesTeamSchedule::with(['route'])
                ->where('sales_team_id', '=', $id)
                ->get();
            return ServiceResponse::statusOK('successfully get schedules', $data);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function patchSchedule(DTOMutate $dto): ServiceResponse
    {
        try {
            $dto->hydrate();
            $dataSchedule = [
                'sales_team_id' => $dto->getSalesTeamID(),
                'route_id' => $dto->getRouteID(),
                'day' => $dto->getDay(),
            ];
            SalesTeamSchedule::updateOrCreate([
                'sales_team_id' => $dto->getSalesTeamID(),
                'day' => $dto->getDay()
            ], $dataSchedule);
            return ServiceResponse::created('successfully create schedule');
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function removeSchedule(DTOMutate $dto): ServiceResponse
    {
        try {
            $dto->hydrate();
            SalesTeamSchedule::with([])
                ->where('sales_team_id', '=', $dto->getSalesTeamID())
                ->where('day', '=', $dto->getDay())
                ->delete();
            return ServiceResponse::statusOK('successfully delete schedule');
        }catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
