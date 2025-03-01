<?php

namespace App\Livewire\Features\MasterData\Route;

use App\Domain\Web\Route\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\RouteService;
use Livewire\Component;

class Table extends Component
{
    /** @var RouteService */
    private $service;

    public function boot(RouteService $service)
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

    public function render()
    {
        return view('livewire.features.master-data.route.table');
    }
}
