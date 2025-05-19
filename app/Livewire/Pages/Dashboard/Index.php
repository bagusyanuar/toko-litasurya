<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.dashboard.index');
    }
}
