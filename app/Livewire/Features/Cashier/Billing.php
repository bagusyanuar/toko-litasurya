<?php

namespace App\Livewire\Features\Cashier;

use App\Domain\Web\Cashier\DTOSubmit;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CashierService;
use App\Services\Web\CustomerService;
use Livewire\Component;

class Billing extends Component
{
    /** @var CashierService $service */
    private $service;

    /** @var DTOSubmit $dto */
    private $dto;

    /** @var CustomerService $customerService */
    private $customerService;

    public function boot(CashierService $service, CustomerService $customerService)
    {
        $this->service = $service;
        $this->customerService = $customerService;
        $this->dto = new DTOSubmit();
    }

    public function customer()
    {
        $response = $this->customerService->findAllByType('personal');
        return AlpineResponse::toJSON($response);
    }

    public function submitOrder($formData)
    {
        $this->dto->hydrateForm($formData);
        $response = $this->service->submitOrder($this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.cashier.billing');
    }
}
