<?php

namespace App\Livewire\Features\Layout;

use App\Helpers\Alpine\AlpineResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UiNavbar extends Component
{
    public $username;
    public $role;

    public function boot()
    {
        $this->username = \auth()->user()->username;
        $this->role = \auth()->user()->role;
    }

    public function logout()
    {
        Auth::logout();
    }

    public function render()
    {
        return view('livewire.features.layout.ui-navbar');
    }
}
