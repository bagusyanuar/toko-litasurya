<?php

namespace App\Livewire\Features\PointRedemption;

use App\Domain\Web\PointRedemption\DTOMutatePointRedemption;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CustomerService;
use App\Services\Web\PointRedemptionService;
use App\Services\Web\RewardService;
use Livewire\Component;

class Form extends Component
{
    /** @var CustomerService $customerService */
    private $customerService;

    /** @var RewardService $rewardService */
    private $rewardService;

    /** @var PointRedemptionService $customerService */
    private $service;

     /** @var DTOMutatePointRedemption $dto */
    private $dto;

    public function boot(PointRedemptionService $service, CustomerService $customerService, RewardService $rewardService)
    {
        $this->service = $service;
        $this->customerService = $customerService;
        $this->rewardService = $rewardService;
        $this->dto = new DTOMutatePointRedemption();
    }

    public function customer()
    {
        $response = $this->customerService->findAllByType('');
        return AlpineResponse::toJSON($response);
    }

    public function reward()
    {
        $response = $this->rewardService->all();
        return AlpineResponse::toJSON($response);
    }

    public function create($formData)
    {
        $this->dto->hydrateForm($formData);
        $response = $this->service->create($this->dto);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.point-redemption.form');
    }
}
