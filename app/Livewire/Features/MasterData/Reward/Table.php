<?php

namespace App\Livewire\Features\MasterData\Reward;

use App\Domain\Web\Reward\DTOFilterReward;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\RewardService;
use Livewire\Component;

class Table extends Component
{
    /** @var RewardService */
    private $service;

    public function boot(RewardService $service)
    {
        $this->service = $service;
    }

    public function findAll($param, $page, $perPage)
    {
        $filter = new DTOFilterReward($param, $page, $perPage);
        $response = $this->service->findAll($filter);
        return AlpineResponse::toJSON($response);
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return AlpineResponse::toJSON($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return AlpineResponse::toJSON($response);
    }
    public function render()
    {
        return view('livewire.features.master-data.reward.table');
    }
}
