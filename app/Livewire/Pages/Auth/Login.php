<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public $onLoading = false;

    public function login()
    {
        sleep(2);
        return $this->redirectRoute('dashboard');
    }

    public function render()
    {
        return view('livewire.pages.auth.login')
            ->layout('layouts.auth');
    }
}
