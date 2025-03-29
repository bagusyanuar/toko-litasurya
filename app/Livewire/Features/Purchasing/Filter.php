<?php

namespace App\Livewire\Features\Purchasing;

use App\Domain\Web\SalesTeam\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CustomerService;
use App\Services\Web\SalesTeamService;
use Livewire\Component;

class Filter extends Component
{
    /** @var CustomerService $customerService */
    private $customerService;

    /** @var SalesTeamService $salesTeamService */
    private $salesTeamService;

    /** @var DTOFilter $dtoFilter */
    private $dtoFilter;

    public function boot(CustomerService $customerService, SalesTeamService $salesTeamService)
    {
        $this->customerService = $customerService;
        $this->salesTeamService = $salesTeamService;
        $this->dtoFilter = new DTOFilter();
    }

    public function stores()
    {
        $response = $this->customerService->findAllByType('store');
        return AlpineResponse::toJSON($response);
    }

    public function sales()
    {
        $this->dtoFilter->hydrateQueryForm([]);
        $response = $this->salesTeamService->all($this->dtoFilter);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.purchasing.filter');
    }
}
