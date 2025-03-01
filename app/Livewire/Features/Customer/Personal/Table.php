<?php

namespace App\Livewire\Features\Customer\Personal;

use App\Domain\Web\Customer\DTOFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CustomerService;
use Livewire\Component;

class Table extends Component
{
    /** @var CustomerService $service */
    private $service;

    public function boot(CustomerService $service)
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
        return view('livewire.features.customer.personal.table');
    }
}
