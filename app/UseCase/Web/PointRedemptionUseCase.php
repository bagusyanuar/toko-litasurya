<?php

namespace App\UseCase\Web;

use App\Commons\Response\ServiceResponse;
use App\Domain\Web\PointRedemption\DTOFilterPointRedemption;
use App\Domain\Web\PointRedemption\DTOMutatePointRedemption;

interface PointRedemptionUseCase
{
    public function findAll(DTOFilterPointRedemption $filter): ServiceResponse;
    public function create(DTOMutatePointRedemption $dto): ServiceResponse;
}
