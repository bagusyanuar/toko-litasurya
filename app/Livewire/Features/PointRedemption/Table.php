<?php

namespace App\Livewire\Features\PointRedemption;

use App\Domain\Web\PointRedemption\DTOFilterPointRedemption;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\PointRedemptionService;
use Livewire\Component;

class Table extends Component
{
    /** @var PointRedemptionService $service */
    private $service;

     /** @var DTOFilterPointRedemption $dto */
    private $dto;

    public function boot(PointRedemptionService $service)
    {
        $this->service = $service;
        $this->dto = new DTOFilterPointRedemption();
    }

    public function findAll($query)
    {
        $this->dto->hydrateQueryForm($query);
        $response = $this->service->findAll($this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.point-redemption.table');
    }
}
