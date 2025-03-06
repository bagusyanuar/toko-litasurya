<?php

namespace App\Livewire\Features\User\Admin;

use App\Domain\Web\Admin\DTOMutate;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\AdminService;
use Livewire\Component;

class Form extends Component
{
    /** @var AdminService $service */
    private $service;

    /** @var DTOMutate $dto */
    private $dto;

    public function boot(AdminService $service)
    {
        $this->service = $service;
        $this->dto = new DTOMutate();
    }

    public function create($formData)
    {
        $this->dto->hydrateForm($formData);
        $response = $this->service->create($this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function update($formData)
    {
        $id = $formData['id'];
        $this->dto->hydrateForm($formData);
        $response = $this->service->update($id, $this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.user.admin.form');
    }
}
