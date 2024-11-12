<?php

namespace App\Livewire\Pages\Category\Section;

use Livewire\Component;

class Create extends Component
{
    public function createNewCategory()
    {
        sleep(2);
    }

    public function render()
    {
        return view('livewire.pages.category.section.create');
    }
}
