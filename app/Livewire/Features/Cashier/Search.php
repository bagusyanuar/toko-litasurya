<?php

namespace App\Livewire\Features\Cashier;

use App\Domain\Web\Item\DTOFilterItem;
use App\Domain\Web\Item\DTOFilterItemPrice;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\ItemService;
use Livewire\Component;

class Search extends Component
{
    /** @var ItemService $itemService */
    private $itemService;

    /** @var DTOFilterItemPrice $filter */
    private $filter;

    public function boot(ItemService $itemService)
    {
        $this->itemService = $itemService;
        $this->filter = new DTOFilterItemPrice();
    }

    public function findAll($param, $page, $perPage)
    {
        $this->filter->hydrateQueryForm([
            'param' => $param,
            'page' => $page,
            'per_page' => $perPage
        ]);
        $response = $this->itemService->findAllItemPrice($this->filter);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.cashier.search');
    }
}
