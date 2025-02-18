<?php

namespace App\Livewire\Features\MasterData\Item;

use App\Domain\Web\Item\DTOFilterItem;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\ItemService;
use Livewire\Component;

class Table extends Component
{
    /** @var ItemService */
    private $service;

    public function boot(ItemService $service)
    {
        $this->service = $service;
    }

    public function findAll($param, $page, $perPage)
    {
        $query = [
            'param' => $param,
            'page' => $page,
            'per_page' => $perPage
        ];
        $filter = new DTOFilterItem();
        $filter
            ->hydrateQueryForm($query)
            ->hydrateQuery();
        $response = $this->service->findAll($filter);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.master-data.item.table');
    }
}
