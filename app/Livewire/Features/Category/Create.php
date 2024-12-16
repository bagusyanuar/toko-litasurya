<?php

namespace App\Livewire\Features\Category;

use App\Domain\Web\Category\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\UploadedFile;
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

    /** @var $categoryRequest  CategoryRequest*/
    protected $categoryRequest;

    public $name;

    public function boot(CategoryService $categoryService)
    {
        $this->service = $categoryService;
        $this->categoryRequest = new CategoryRequest();
    }

    public function createNewCategory()
    {
        $this->categoryRequest->setName($this->name)
            ->setFile($this->file);
        $serviceResponse = $this->service->createNewCategory($this->categoryRequest);
        if (!$serviceResponse->isSuccess()) {
            $this->dispatch('page-error', true, $serviceResponse->getMessage());
            return;
        }
        $this->dispatch('page-success', true, 'Berhasil menyimpan data kategori');
        $this->dispatch('fetch-categories');
    }

    #[On('check')]
    public function check()
    {
        sleep(2);
    }

    public function render()
    {
        return view('livewire.features.category.create');
    }
}
