<?php

namespace App\Livewire\Features\Category;

use App\Domain\Web\Category\CategoryFilter;
use App\Services\CategoryService;
use Livewire\Component;
use Livewire\Attributes\On;

class Lists extends Component
{
    /** @var $service CategoryService */
    protected $service;

    /** @var $filter CategoryFilter */
    protected $filter;

    public $data = [];
    public $onLoading = true;

    protected $listeners = [
        'getDataCategories'
    ];

    public function boot(CategoryService $categoryService)
    {
        $this->service = $categoryService;
        $this->filter = new CategoryFilter('', 1, 10);
    }

    #[On('fetch-categories')]
    public function getDataCategories()
    {
        $this->onLoading = true;
        $serviceResponse = $this->service->getDataCategories($this->filter);
        if ($serviceResponse->isSuccess()) {
            $this->data = $serviceResponse->getData();
        }
        $this->onLoading = false;
    }

    #[On('fetch-categories-no-reload')]
    public function getDataCategoriesNoReload()
    {
        $serviceResponse = $this->service->getDataCategories($this->filter);
        if ($serviceResponse->isSuccess()) {
            $this->data = $serviceResponse->getData();
        }
    }

    public function render()
    {
        return view('livewire.features.category.lists');
    }
}
