<?php

namespace App\Livewire\Features\MasterData\Route;

use App\Domain\Web\Route\DTOMutate;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CustomerService;
use App\Services\Web\RouteService;
use Livewire\Component;

class Form extends Component
{
    /** @var CustomerService $customerService */
    private $customerService;

    /** @var DTOMutate $dto */
    private $dto;

    /** @var RouteService $service */
    private $service;

    public function boot(RouteService $service, CustomerService $customerService)
    {
        $this->service = $service;
        $this->customerService = $customerService;
        $this->dto = new DTOMutate();
    }

    public function stores()
    {
        $response = $this->customerService->findAllByType('store');
        return AlpineResponse::toJSON($response);
    }

    public function create($formData)
    {
        $this->dto->hydrateForm($formData);
        $response = $this->service->create($this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function update($formData)
    {
        $id = $formData['id'];
        $this->dto->hydrateForm($formData);
        $response = $this->service->update($id, $this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.master-data.route.form');
    }
}
