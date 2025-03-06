<?php

namespace App\Livewire\Features\User\SalesTeam;

use App\Domain\Web\SalesTeam\DTOMutate;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\SalesTeamService;
use Livewire\Component;

class Form extends Component
{
    /** @var SalesTeamService $service */
    private $service;

    /** @var DTOMutate $dto */
    private $dto;

    public function boot(SalesTeamService $service)
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
        return view('livewire.features.user.sales-team.form');
    }
}
