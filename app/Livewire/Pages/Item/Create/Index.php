<?php

namespace App\Livewire\Pages\Item\Create;

use App\Helpers\Livewire\PageComponent;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends PageComponent
{
    use WithFileUploads;

    /** @var string $name */
    public $name;

    public $category;

    /** @var string $description */
    public $description;

    /** @var $file UploadedFile | null */
    public $file;

    public $retailPrice;

    public $cartonPrice;

    public $cartonPriceDescription;

    public $categoryOptions = [
        [
            'value' => '1',
            'text' => 'Kategori 1'
        ],
        [
            'value' => '2',
            'text' => 'Kategori 2'
        ],
    ];

    public function onSave()
    {
        dd($this->category);
    }
    public function render()
    {
        return view('livewire.pages.item.create.index');
    }
}
