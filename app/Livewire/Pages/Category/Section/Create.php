<?php

namespace App\Livewire\Pages\Category\Section;

use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $files = [];

    public function createNewCategory()
    {
        sleep(2);
    }

    public function render()
    {
        return view('livewire.pages.category.section.create');
    }
}
