<?php

namespace App\Livewire\Pages\Item\Create;

use App\Helpers\Livewire\PageComponent;
use Livewire\Component;

class Index extends PageComponent
{
    public $name;
    public $category;
    public $categoryOptions = [
        [
            'value' => '1',
            'text' => 'Kategori 1'
        ],
        [
            'value' => '2',
            'text' => 'Kategori 2'
        ],
    ];

    public function onSave()
    {
        dd($this->category);
    }
    public function render()
    {
        return view('livewire.pages.item.create.index');
    }
}
