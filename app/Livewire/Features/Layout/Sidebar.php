<?php

namespace App\Livewire\Features\Layout;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Livewire\Component;

class Sidebar extends Component
{
    public $masterGroup = ['category', 'item'];

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.features.layout.sidebar');
    }
}
