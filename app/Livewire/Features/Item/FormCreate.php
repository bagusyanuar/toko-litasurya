<?php

namespace App\Livewire\Features\Item;

use App\Services\CategoryService;
use App\Services\Web\ItemService;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormCreate extends Component
{
    use WithFileUploads;

    /** @var CategoryService $categoryService */
    private $categoryService;
    /** @var ItemService $itemService */
    private $itemService;
    public $categoryOptions = [];

    //form attributes
    public $name;
    public $category;
    public $description;
    /** @var UploadedFile | null $image */
    public $image;
    public $retailPrice;
    public $dozenPrice;

    public $prices = [
        [
            'key' => 'retail',
            'value' => 0,
            'description' => ''
        ],
        [
            'key' => 'dozen',
            'value' => 0,
            'description' => ''
        ],
        [
            'key' => 'carton',
            'value' => 0,
            'description' => ''
        ],
    ];

    public function boot(CategoryService $categoryService, ItemService $itemService)
    {
        $this->categoryService = $categoryService;
        $this->itemService = $itemService;
    }

    public function mount()
    {
        $categoryResponse = $this->categoryService->getDataCategoriesNoPagination();
        if($categoryResponse->isSuccess()) {
            $this->categoryOptions = [];
            $data = $categoryResponse->getData();
            foreach ($data as $datum) {
                $option['value'] = $datum->id;
                $option['text'] = $datum->name;
                array_push($this->categoryOptions, $option);
            }
        }
    }

    public function cek()
    {
        dd($this->prices);
    }
    public function render()
    {
        return view('livewire.features.item.form-create');
    }
}
