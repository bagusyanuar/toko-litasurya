<?php

namespace App\Livewire\Features\Dashboard;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\DashboardService;
use Livewire\Component;

class Widget extends Component
{
    /** @var DashboardService $service */
    protected $service;

    public function boot(DashboardService $service)
    {
        $this->service = $service;
    }

    public function getStoreCount()
    {
        $response = $this->service->getStoreCount();
        return AlpineResponse::toJSON($response);
    }

    public function getMemberCount()
    {
        $response = $this->service->getMemberCount();
        return AlpineResponse::toJSON($response);
    }

    public function getTotalRevenue()
    {
        $response = $this->service->getTotalRevenue();
        return AlpineResponse::toJSON($response);
    }

    public function getProductCount()
    {
        $response = $this->service->getProductCount();
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.dashboard.widget');
    }
}
