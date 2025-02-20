<?php

namespace App\Livewire\Features\MasterData\Item;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CategoryService;
use App\Services\Web\ItemService;
use Livewire\Component;

class Form extends Component
{
    /** @var CategoryService $categoryService */
    private $categoryService;

    /** @var ItemService */
    private $service;

    public function boot(ItemService $service, CategoryService $categoryService)
    {
        $this->service = $service;
        $this->categoryService = $categoryService;
    }

    public function categories()
    {
        $response = $this->categoryService->all();
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.master-data.item.form');
    }
}
