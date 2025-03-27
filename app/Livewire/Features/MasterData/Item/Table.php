<?php

namespace App\Livewire\Features\MasterData\Item;

use App\Domain\Web\Category\DTOCategoryFilter;
use App\Domain\Web\Item\DTOFilterItem;
use App\Domain\Web\Item\DTOMutatePrices;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\ItemService;
use Livewire\Component;

class Table extends Component
{
    /** @var ItemService */
    private $service;

    /** @var DTOMutatePrices $dtoUpdatePrice */
    private $dtoUpdatePrice;

    public function boot(ItemService $service)
    {
        $this->service = $service;
        $this->dtoUpdatePrice = new DTOMutatePrices();
    }

    public function findAll($param, $page, $perPage)
    {
        $filter = new DTOFilterItem($param, $page, $perPage);
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

    public function updatePrice($formData)
    {
        $this->dtoUpdatePrice->hydrateForm($formData);
        $response = $this->service->updatePriceList($this->dtoUpdatePrice);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.master-data.item.table');
    }
}
