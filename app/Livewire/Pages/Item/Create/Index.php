<?php

namespace App\Livewire\Pages\Item\Create;

use App\Helpers\Livewire\PageComponent;
use Livewire\Component;

class Index extends PageComponent
{
    public $categoryOptions = [
        [
            'value' => '1',
            'text' => 'Nama Barang'
        ]
    ];
    public function render()
    {
        return view('livewire.pages.item.create.index');
    }
}
