<?php

namespace App\Livewire\Features\MasterData\Item;

use App\Domain\Web\Item\DTOMutateItem;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CategoryService;
use App\Services\Web\ItemService;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    /** @var CategoryService $categoryService */
    private $categoryService;

    /** @var DTOMutateItem $dto */
    private $dto;

    /** @var ItemService */
    private $service;

    /** @var $file UploadedFile | null */
    public $file;

    public function boot(ItemService $service, CategoryService $categoryService)
    {
        $this->service = $service;
        $this->categoryService = $categoryService;
        $this->dto = new DTOMutateItem();
    }

    public function categories()
    {
        $response = $this->categoryService->all();
        return AlpineResponse::toJSON($response);
    }

    public function create($formData)
    {
        $dtoForm = [
            'category_id' => $formData['category'],
            'name' => $formData['name'],
            'file' => $this->file,
            'description' => $formData['description'],
            'pricing' => $formData['pricing']
        ];
        $this->dto->hydrateForm($dtoForm);
        $response = $this->service->create($this->dto);
        if ($response->isSuccess()) {
            $this->reset(['file']);
        }
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.master-data.item.form');
    }
}
