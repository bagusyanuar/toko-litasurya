<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public $onLoading = false;


    public function mount()
    {
        $this->onLoading = false;
    }

    public function submitLogin()
    {
        $this->onLoading = true;
        sleep(5);
        $this->onLoading = false;
//        $this->onLoading = false;
    }

    public function submitLogin2()
    {
        $this->onLoading = true;
        sleep(5);
        $this->onLoading = false;
//        $this->onLoading = false;
    }


    public function render()
    {
        return view('livewire.pages.auth.login')
            ->layout('layouts.auth');
    }
}
