<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Schedule\DTOMutate;

interface ScheduleUseCase
{
    public function findBySalesID($id): ServiceResponse;
    public function patchSchedule(DTOMutate $dto): ServiceResponse;
    public function removeSchedule(DTOMutate $dto): ServiceResponse;
}
