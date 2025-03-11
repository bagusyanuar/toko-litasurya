<?php

namespace App\Livewire\Features\SellingReport;

use App\Domain\Web\SellingReport\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\SellingReportService;
use Livewire\Component;

class Table extends Component
{
    /** @var SellingReportService $service */
    private $service;

    /** @var DTOFilter $dto */
    private $dto;

    public function boot(SellingReportService $service)
    {
        $this->service = $service;
        $this->dto = new DTOFilter();
    }

    public function findAll($query)
    {
        $this->dto->hydrateQueryForm($query);
        $response = $this->service->findAll($this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.selling-report.table');
    }
}
