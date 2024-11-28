<?php

namespace App\Livewire\Features\Layout;

use Livewire\Component;

class Sidebar extends Component
{
    public $masterRoutes = ['category.list', 'item.list'];

    public function render()
    {
        return view('livewire.features.layout.sidebar');
    }
}
