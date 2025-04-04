<?php

namespace App\Livewire\Features\Dashboard;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\DashboardService;
use Livewire\Component;

class SellingChart extends Component
{
    /** @var DashboardService $service */
    protected $service;

    public function boot(DashboardService $service)
    {
        $this->service = $service;
    }

    public function getSellingChart()
    {
        $response = $this->service->getSellingChart();
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.dashboard.selling-chart');
    }
}
