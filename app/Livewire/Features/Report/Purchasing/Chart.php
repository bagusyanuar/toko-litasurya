<?php

namespace App\Livewire\Features\Report\Purchasing;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\PurchasingReportService;
use Livewire\Component;

class Chart extends Component
{
    /** @var PurchasingReportService $service */
    private $service;

    public function boot(PurchasingReportService $service)
    {
        $this->service = $service;
    }

    public function createChart($year)
    {
        $response = $this->service->makeChart($year);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.report.purchasing.chart');
    }
}
