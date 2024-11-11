<?php

namespace App\Livewire\Pages\Category\Section\DataList;

use Livewire\Component;
use Livewire\Attributes\On;

class CategoryList extends Component
{
    public $data = [];
    public $onLoading = true;

    #[On('fetch-categories')]
    public function getDataCategories()
    {
        $this->onLoading = true;
        sleep(2);
        $this->onLoading = false;
    }

    public function render()
    {
        return view('livewire.pages.category.section.data-list.category-list');
    }
}
