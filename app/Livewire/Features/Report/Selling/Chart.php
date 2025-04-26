<?php

namespace App\Livewire\Features\Report\Selling;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\SellingReportService;
use Livewire\Component;

class Chart extends Component
{
    /** @var SellingReportService $service */
    private $service;

    public function boot(SellingReportService $service)
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
        return view('livewire.features.report.selling.chart');
    }
}
