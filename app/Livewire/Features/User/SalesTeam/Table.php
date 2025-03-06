<?php

namespace App\Livewire\Features\User\SalesTeam;

use App\Domain\Web\SalesTeam\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\SalesTeamService;
use Livewire\Component;

class Table extends Component
{
    /** @var SalesTeamService $service */
    private $service;

    public function boot(SalesTeamService $service)
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

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return AlpineResponse::toJSON($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.user.sales-team.table');
    }
}
