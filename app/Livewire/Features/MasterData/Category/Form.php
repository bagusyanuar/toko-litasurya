<?php

namespace App\Livewire\Features\MasterData\Category;

use App\Domain\Web\Category\DTOCategoryRequest;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CategoryService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Form extends Component
{
    use WithFileUploads;

    /** @var CategoryService $service */
    protected $service;

    /** @var DTOCategoryRequest $dto */
    private $dto;

    /** @var $file UploadedFile | null */
    public $file;


    public function boot(CategoryService $categoryService)
    {
        $this->service = $categoryService;
        $this->dto = new DTOCategoryRequest();
    }

    public function create($formData)
    {
        $dtoForm = [
            'name' => $formData['name'],
            'file' => $this->file
        ];
        $this->dto->hydrateForm($dtoForm);
        $response = $this->service->create($this->dto);
        if ($response->isSuccess()) {
            $this->reset(['file']);
        }
        return AlpineResponse::toJSON($response);
    }

    public function update($id)
    {
        $dtoForm = [
            'name' => $this->name,
            'file' => $this->file
        ];
        $this->dto->hydrateForm($dtoForm);
        $response = $this->service->update($id, $this->dto);
        if ($response->isSuccess()) {
            $this->reset(['name', 'file']);
        }
        return AlpineResponse::toResponse(
            $response->isSuccess(),
            $response->getStatus(),
            $response->getMessage(),
            $response->getData(),
            $response->getMeta()
        );
    }

    public function render()
    {
        return view('livewire.features.master-data.category.form');
    }
}
