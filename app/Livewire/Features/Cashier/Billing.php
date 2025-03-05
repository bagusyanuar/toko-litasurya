<?php

namespace App\Livewire\Features\Cashier;

use App\Domain\Web\Cashier\DTOSubmit;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CashierService;
use Livewire\Component;

class Billing extends Component
{
    /** @var CashierService $service */
    private $service;

    /** @var DTOSubmit $dto */
    private $dto;

    public function boot(CashierService $service)
    {
        $this->service = $service;
        $this->dto = new DTOSubmit();
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
