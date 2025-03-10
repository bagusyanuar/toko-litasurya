<?php

namespace App\Livewire\Features\Purchasing;

use App\Domain\Web\Purchasing\DTOOrder;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\PurchasingService;
use Livewire\Component;

class Process extends Component
{
    /** @var PurchasingService $service */
    private $service;

    /** @var DTOOrder $dto */
    private $dto;

    public function boot(PurchasingService $service)
    {
        $this->service = $service;
        $this->dto = new DTOOrder();
    }

    public function order($id, $carts)
    {
        $formData = [
            'invoice_id' => $id,
            'carts' => $carts
        ];
        $this->dto->hydrateForm($formData);
        $response = $this->service->placeOrder($id, $this->dto);
        return AlpineResponse::toJSON($response);
    }
    
    public function render()
    {
        return view('livewire.features.purchasing.process');
    }
}
