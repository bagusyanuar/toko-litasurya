<?php

namespace App\Livewire\Features\Item;

use Livewire\Component;

class FormCreate extends Component
{
    public $name;
    public $category;

    public $categoryOptions = [];

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.features.item.form-create');
    }
}
