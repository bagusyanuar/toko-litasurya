<?php

namespace App\Livewire\Features\Report\SellingReturn;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\SellingReturnReportService;
use Livewire\Component;

class Chart extends Component
{
    /** @var SellingReturnReportService $service */
    private $service;

    public function boot(SellingReturnReportService $service)
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
        return view('livewire.features.report.selling-return.chart');
    }
}
