<?php

namespace App\Livewire\Features\MasterData\Item;

use App\Domain\Web\Item\DTOMutatePriceList;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\ItemService;
use Livewire\Component;

class PriceList extends Component
{
    /** @var DTOMutatePriceList $dto */
    private $dto;

    /** @var ItemService */
    private $service;

    public function boot(ItemService $service)
    {
        $this->service = $service;
        $this->dto = new DTOMutatePriceList();
    }

    public function mutate($formData)
    {
        $this->dto->hydrateForm($formData);
        $response = $this->service->mutatePriceList($this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.master-data.item.price-list');
    }
}
