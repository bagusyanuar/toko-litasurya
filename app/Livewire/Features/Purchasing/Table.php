<?php

namespace App\Livewire\Features\Purchasing;

use App\Domain\Web\Purchasing\DTOFilter;
use App\Domain\Web\Purchasing\DTOPurchase;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\PurchasingService;
use Livewire\Component;

class Table extends Component
{


    /** @var PurchasingService $service */
    private $service;

    /** @var DTOFilter $dto */
    private $dto;

    /** @var DTOPurchase $dtoSubmit */
    private $dtoSubmit;

    public function boot(PurchasingService $service)
    {
        $this->service = $service;
        $this->dto = new DTOFilter();
        $this->dtoSubmit = new DTOPurchase();
    }

    public function findAll($query)
    {
        $this->dto->hydrateQueryForm($query);
        $response = $this->service->findAll($this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return AlpineResponse::toJSON($response);
    }

    public function submitPurchase($formData)
    {
        $this->dtoSubmit->hydrateForm($formData);
        $response = $this->service->submitPurchase($this->dtoSubmit);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.purchasing.table');
    }
}
