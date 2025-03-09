<?php

namespace App\Livewire\Features\Purchasing;

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

    public function boot(CustomerService $customerService, SalesTeamService $salesTeamService)
    {
        $this->customerService = $customerService;
        $this->salesTeamService = $salesTeamService;
    }

    public function stores()
    {
        $response = $this->customerService->findAllByType('store');
        return AlpineResponse::toJSON($response);
    }

    public function sales()
    {
        $response = $this->salesTeamService->all();
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.purchasing.filter');
    }
}
