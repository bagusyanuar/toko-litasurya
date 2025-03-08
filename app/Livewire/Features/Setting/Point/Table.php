<?php

namespace App\Livewire\Features\Setting\Point;

use App\Domain\Web\Point\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\PointService;
use Livewire\Component;

class Table extends Component
{
    /** @var PointService */
    private $service;

    public function boot(PointService $service)
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

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return AlpineResponse::toJSON($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.setting.point.table');
    }
}
