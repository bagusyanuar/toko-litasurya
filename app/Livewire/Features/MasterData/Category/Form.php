<?php

namespace App\Livewire\Features\MasterData\Category;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CategoryService;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    /** @var CategoryService $service */
    protected $service;

    /** @var $file UploadedFile | null */
    public $file;


    public function boot(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function create()
    {
        sleep(2);

        return AlpineResponse::toResponse(true, 200, '', null, null);
    }

    public function render()
    {
        return view('livewire.features.master-data.category.form');
    }
}
