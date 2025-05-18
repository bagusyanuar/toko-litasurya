<?php

namespace App\Livewire\Features\SellingReturn;

use App\Domain\Web\SellingReturn\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\SellingReturnService;
use Livewire\Component;

class Table extends Component
{
    /** @var SellingReturnService $service */
    private $service;

    public function boot(SellingReturnService $service)
    {
        $this->service = $service;
    }

    public function findAll($query)
    {
        $filter = new DTOFilter();
        $filter->hydrateQueryForm($query);
        $response = $this->service->findAll($filter);
        return AlpineResponse::toJSON($response);
    }

    public function submitReturn($id)
    {
        $response = $this->service->submitReturn($id);
        return AlpineResponse::toJSON($response);
    }
    public function render()
    {
        return view('livewire.features.selling-return.table');
    }
}
