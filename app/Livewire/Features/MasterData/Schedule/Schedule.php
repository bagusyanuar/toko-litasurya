<?php

namespace App\Livewire\Features\MasterData\Schedule;

use App\Domain\Web\Schedule\DTOMutate;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\RouteService;
use App\Services\Web\ScheduleService;
use Livewire\Component;

class Schedule extends Component
{
    /** @var ScheduleService $service */
    private $service;

    /** @var RouteService $routeService */
    private $routeService;

    /** @var DTOMutate $dtoMutate */
    private $dtoMutate;
    public function boot(ScheduleService $service)
    {
        $this->service = $service;
        $this->routeService = new RouteService();
        $this->dtoMutate = new DTOMutate();
    }

    public function schedules($id)
    {
        $response = $this->service->findBySalesID($id);
        return AlpineResponse::toJSON($response);
    }

    public function routes()
    {
        $response = $this->routeService->all();
        return AlpineResponse::toJSON($response);
    }

    public function patchSchedule($formData)
    {
        $this->dtoMutate->hydrateForm($formData);
        $response = $this->service->patchSchedule($this->dtoMutate);
        return AlpineResponse::toJSON($response);
    }

    public function removeSchedule($formData)
    {
        $this->dtoMutate->hydrateForm($formData);
        $response = $this->service->removeSchedule($this->dtoMutate);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.master-data.schedule.schedule');
    }
}
