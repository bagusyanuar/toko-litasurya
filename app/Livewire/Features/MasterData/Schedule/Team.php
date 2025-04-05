<?php

namespace App\Livewire\Features\MasterData\Schedule;

use App\Domain\Web\SalesTeam\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\SalesTeamService;
use Livewire\Component;

class Team extends Component
{
    /** @var SalesTeamService $salesTeamService */
    private $salesTeamService;

    /** @var DTOFilter $dtoFilter */
    private $dtoFilter;

    public function boot(SalesTeamService $salesTeamService)
    {
        $this->salesTeamService = $salesTeamService;
        $this->dtoFilter = new DTOFilter();
    }

    public function sales($query)
    {
        $this->dtoFilter->hydrateQueryForm($query);
        $response = $this->salesTeamService->all($this->dtoFilter);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.master-data.schedule.team');
    }
}
