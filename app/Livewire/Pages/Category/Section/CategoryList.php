<?php

namespace App\Livewire\Pages\Category\Section;

use App\Services\CategoryService;
use Livewire\Component;
use Livewire\Attributes\On;

class CategoryList extends Component
{
    /** @var $service CategoryService */
    protected $service;
    public $data = [];
    public $onLoading = true;

    public function boot(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    #[On('fetch-categories')]
    public function getDataCategories()
    {
        $this->onLoading = true;
        $this->service->getDataCategories();
        $this->onLoading = false;
    }

    public function render()
    {
        return view('livewire.pages.category.section.category-list');
    }
}
