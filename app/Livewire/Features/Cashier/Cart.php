<?php

namespace App\Livewire\Features\Cashier;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\ItemService;
use Livewire\Component;

class Cart extends Component
{
    /** @var ItemService $itemService */
    private $itemService;

    public function boot(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function getProductByPLU($plu)
    {
        $response = $this->itemService->findByPriceListUnit($plu);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.cashier.cart');
    }
}
