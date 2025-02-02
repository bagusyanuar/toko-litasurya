<?php

namespace App\Livewire\Features\MasterData\Category;

use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public function create()
    {
        sleep(2);
    }

    public function render()
    {
        return view('livewire.features.master-data.category.form');
    }
}
