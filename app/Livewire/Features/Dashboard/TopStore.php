<?php

namespace App\Livewire\Features\Dashboard;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\DashboardService;
use Livewire\Component;

class TopStore extends Component
{
    /** @var DashboardService $service */
    protected $service;

    public function boot(DashboardService $service)
    {
        $this->service = $service;
    }

    public function getTopStore()
    {
        $response = $this->service->getTopStore();
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.dashboard.top-store');
    }
}
