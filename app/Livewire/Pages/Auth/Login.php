<?php

namespace App\Livewire\Pages\Auth;

use App\Domain\Web\Auth\DTOLogin;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\AuthService;
use Livewire\Component;

class Login extends Component
{

    /** @var AuthService $service */
    private $service;

    /** @var DTOLogin $dto */
    private $dto;

    public function boot(AuthService $service)
    {
        $this->service = $service;
        $this->dto = new DTOLogin();
    }


    public function login($dtoForm)
    {
        $this->dto->hydrateForm($dtoForm);
        $response = $this->service->login($this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.pages.auth.login')
            ->layout('layouts.auth');
    }
}
