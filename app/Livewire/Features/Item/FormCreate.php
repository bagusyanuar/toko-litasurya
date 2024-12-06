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

    public $prices = [
        [
            'key' => 'retail',
            'value' => 0,
            'plu' => '',
            'description' => ''
        ],
        [
            'key' => 'dozen',
            'value' => 0,
            'plu' => '',
            'description' => ''
        ],
        [
            'key' => 'carton',
            'value' => 0,
            'plu' => '',
            'description' => ''
        ],
        [
            'key' => 'trader',
            'value' => 0,
            'plu' => '',
            'description' => ''
        ],
    ];

    public $step = 1;

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

    public function createNewItem()
    {
        sleep(2);
    }

    public function goToStep($step)
    {
        $this->step = $step;
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
