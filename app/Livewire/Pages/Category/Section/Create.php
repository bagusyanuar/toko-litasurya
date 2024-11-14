<?php

namespace App\Livewire\Pages\Category\Section;

use App\Domain\Web\Category\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Ramsey\Uuid\Uuid;

class Create extends Component
{
    use WithFileUploads;

    /** @var $service CategoryService */
    private $service;
    /** @var $file UploadedFile | null */
    public $file;
    public $name;

    public function createNewCategory()
    {
        $categoryRequest = new CategoryRequest($this->name, $this->file);
        $serviceResponse = $this->service->createNewCategory($categoryRequest);
        if (!$serviceResponse->isSuccess()) {
            dd($serviceResponse->getMessage());
        }
    }

    public function boot(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function render()
    {
        return view('livewire.pages.category.section.create');
    }
}
