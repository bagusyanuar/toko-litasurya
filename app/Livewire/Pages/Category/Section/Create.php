<?php

namespace App\Livewire\Pages\Category\Section;

use App\Services\CategoryService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Ramsey\Uuid\Uuid;

class Create extends Component
{
    use WithFileUploads;

    private $service;
    public $files;

    public function createNewCategory()
    {
        $storage_path = public_path('static/image/category');
        if (!File::exists($storage_path)) {
            File::makeDirectory($storage_path, 0755, true);
        }
        /** @var UploadedFile $file */
        foreach ($this->files as $file) {
            $extension = $file->getClientOriginalExtension();
            $image = Uuid::uuid4()->toString() . '.' . $extension;
            $imageName = $storage_path . '/' . $image;
            $tempPath = $file->getRealPath();
            File::move($tempPath, $imageName);
        }
        dd('success');
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
