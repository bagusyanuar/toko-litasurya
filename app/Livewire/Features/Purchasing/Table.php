<?php

namespace App\Livewire\Features\Purchasing;

use App\Domain\Web\Purchasing\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\PurchasingService;
use Livewire\Component;

class Table extends Component
{


    /** @var PurchasingService $service */
    private $service;

    /** @var DTOFilter $dto */
    private $dto;

    public function boot(PurchasingService $service)
    {
        $this->service = $service;
        $this->dto = new DTOFilter();
    }

    public function findAll($query)
    {
        $this->dto->hydrateQueryForm($query);
        $response = $this->service->findAll($this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.purchasing.table');
    }
}
