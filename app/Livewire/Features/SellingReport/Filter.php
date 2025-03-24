<?php

namespace App\Livewire\Features\SellingReport;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CustomerService;
use App\Services\Web\SalesTeamService;
use Livewire\Component;

class Filter extends Component
{
    /** @var CustomerService $customerService */
    private $customerService;

    public function boot(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function customers()
    {
        $response = $this->customerService->findAllByType('');
        return AlpineResponse::toJSON($response);
    }
    public function render()
    {
        return view('livewire.features.selling-report.filter');
    }
}
