<?php

namespace App\Livewire\Features\User\Admin;

use App\Domain\Web\Admin\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\AdminService;
use Livewire\Component;

class Table extends Component
{
    /** @var AdminService $service */
    private $service;

    public function boot(AdminService $service)
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
        return view('livewire.features.user.admin.table');
    }
}
