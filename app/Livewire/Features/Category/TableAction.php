<?php

namespace App\Livewire\Features\Category;

use App\Services\CategoryService;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class TableAction extends Component
{
    use WithFileUploads;

    /** @var $file UploadedFile | null */
    public $file;

    public $idx;
    public $category;
    public $name;

    /** @var $service CategoryService */
    private $service;

    public function boot(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function mount()
    {
        $this->name = $this->category->name;
    }

    public function onDeleteCategory()
    {
        $categoryID = $this->category->id;
        $serviceResponse = $this->service->deleteCategory($categoryID);
        if (!$serviceResponse->isSuccess()) {
            $this->dispatch('page-error', true, $serviceResponse->getMessage());
            return;
        }
        $this->dispatch('page-success', true, 'Berhasil menghapus data kategori.');
        $this->dispatch('fetch-categories-no-reload');
    }

    public function render()
    {
        return view('livewire.features.category.table-action');
    }
}
