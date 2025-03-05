<?php

namespace App\Livewire\Features\Layout;

use App\Helpers\Alpine\AlpineResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UiNavbar extends Component
{
    public function logout()
    {
        Auth::logout();
    }

    public function render()
    {
        return view('livewire.features.layout.ui-navbar');
    }
}
