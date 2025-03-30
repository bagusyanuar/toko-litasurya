<?php

namespace App\Livewire\Features\SalesTeam\StoreVisit;

use App\Domain\Web\SalesTeamVisit\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\SalesTeamVisitService;
use Livewire\Component;

class Table extends Component
{
    /** @var SalesTeamVisitService $service */
    private $service;

    /** @var DTOFilter $dtoFilter */
    private $dtoFilter;

    public function boot(SalesTeamVisitService $service)
    {
        $this->service = $service;
        $this->dtoFilter = new DTOFilter();
    }

    public function findAll($query)
    {
        $this->dtoFilter->hydrateQueryForm($query);
        $response = $this->service->findAll($this->dtoFilter);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.sales-team.store-visit.table');
    }
}
