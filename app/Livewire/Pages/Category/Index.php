<?php

namespace App\Livewire\Pages\Category;

use App\Helpers\Livewire\PageComponent;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends PageComponent
{
    public function render()
    {
        return view('livewire.pages.category.index');
    }
}
