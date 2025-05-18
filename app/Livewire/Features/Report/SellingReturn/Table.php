<?php

namespace App\Livewire\Features\Report\SellingReturn;

use App\Domain\Web\SellingReturnReport\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\SellingReturnReportService;
use Livewire\Component;

class Table extends Component
{
    /** @var SellingReturnReportService $service */
    private $service;

    public function boot(SellingReturnReportService $service)
    {
        $this->service = $service;
    }

    public function findAll($query)
    {
        $filter = new DTOFilter();
        $filter->hydrateQueryForm($query);
        $response = $this->service->findAll($filter);
        return AlpineResponse::toJSON($response);
    }

    public function printToPDF($query)
    {
        $filter = new DTOFilter();
        $filter->hydrateQueryForm($query);
        $response = $this->service->printToPDF($filter);
        return AlpineResponse::toJSON($response);
    }

    public function printToExcel($query)
    {
        $filter = new DTOFilter();
        $filter->hydrateQueryForm($query);
        $response = $this->service->printToExcel($filter);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.report.selling-return.table');
    }
}
