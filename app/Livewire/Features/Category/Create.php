<?php

namespace App\Livewire\Features\Category;

use App\Domain\Web\Category\CategoryRequest;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\CategoryService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Create extends Component
{
    use WithFileUploads;

    /** @var $service CategoryService */
    private $service;

    /** @var $file UploadedFile | null */
    public $file;

    /** @var $categoryRequest  CategoryRequest */
    protected $categoryRequest;

    public $name;

    public function boot(CategoryService $categoryService)
    {
        $this->service = $categoryService;
        $this->categoryRequest = new CategoryRequest();
    }

    #[On('category-create')]
    public function createNewCategory()
    {
        $this->categoryRequest->setName($this->name)
            ->setFile($this->file);
        $serviceResponse = $this->service->createNewCategory($this->categoryRequest);
        if (!$serviceResponse->isSuccess()) {
            if ($serviceResponse->getCode() === 400) {
                /** @var MessageBag $errors */
                $errors = $serviceResponse->getData();
                return AlpineResponse::toResponse(
                    false,
                    400,
                    $serviceResponse->getMessage(),
                    $errors
                );
            }
            $this->dispatch('page-error', true, $serviceResponse->getMessage());
            return AlpineResponse::toResponse(
                false,
                500,
                $serviceResponse->getMessage(),
                $serviceResponse->getData()
            );
        }
        $this->dispatch('page-success', true, 'Berhasil menyimpan data kategori');
        $this->dispatch('fetch-categories');
        return AlpineResponse::toResponse(
            true,
            200,
            'Berhasil menyimpan data kategori',
            null);
    }

    public function render()
    {
        return view('livewire.features.category.create');
    }
}
