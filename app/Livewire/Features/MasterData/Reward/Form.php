<?php

namespace App\Livewire\Features\MasterData\Reward;

use App\Domain\Web\Item\DTOMutateItem;
use App\Domain\Web\Reward\DTOMutateReward;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CategoryService;
use App\Services\Web\ItemService;
use App\Services\Web\RewardService;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    /** @var RewardService $service */
    private $service;

    /** @var DTOMutateReward $dto */
    private $dto;

    /** @var $file UploadedFile | null */
    public $file;

    public function boot(RewardService $service)
    {
        $this->service = $service;
        $this->dto = new DTOMutateReward();
    }

    public function create($formData)
    {
        $dtoForm = [
            'name' => $formData['name'],
            'image' => $this->file,
            'point' => $formData['point'],
        ];
        $this->dto->hydrateForm($dtoForm);
        $response = $this->service->create($this->dto);
        if ($response->isSuccess()) {
            $this->reset(['file']);
        }
        return AlpineResponse::toJSON($response);
    }

    public function update($formData)
    {
        $id = $formData['id'];
        $dtoForm = [
            'name' => $formData['name'],
            'image' => $this->file,
            'point' => $formData['point'],
        ];
        $this->dto->hydrateForm($dtoForm);
        $response = $this->service->update($id, $this->dto);
        if ($response->isSuccess()) {
            $this->reset(['file']);
        }
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.master-data.reward.form');
    }
}
