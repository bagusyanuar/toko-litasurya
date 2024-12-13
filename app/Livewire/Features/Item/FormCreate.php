<?php

namespace App\Livewire\Features\Item;

use App\Domain\Web\Item\ItemPriceRequest;
use App\Domain\Web\Item\ItemRequest;
use App\Helpers\Constant\Pricing;
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

    public $prices = Pricing::INITIAL_PRICING;

    public $step = 1;

    public $exampleLoading = false;

    public function loadingProcess()
    {
        sleep(2);
    }

    public function boot(CategoryService $categoryService, ItemService $itemService)
    {
        $this->categoryService = $categoryService;
        $this->itemService = $itemService;
    }

    public function mount()
    {
        $categoryResponse = $this->categoryService->getDataCategoriesNoPagination();
        if($categoryResponse->isSuccess()) {
            $this->categoryOptions = [
                [
                    'value' => '',
                    'text' => '-- pilih kategori --'
                ]
            ];
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
        $categoryID = $this->category['id'];
        $name = $this->name;
        $image = $this->image;
        $description = $this->description;

        /** @var ItemPriceRequest[] $itemPriceRequests */
        $itemPriceRequests = [];
        foreach ($this->prices as $price) {
            $itemPrice = (int) str_replace('.', '', $price['value']);
            $itemPriceRequest = new ItemPriceRequest(
                '',
                $price['plu'],
                $itemPrice,
                $price['key'],
                $price['description']
            );
            array_push($itemPriceRequests, $itemPriceRequest);
        }
        $itemRequest = new ItemRequest(
            $categoryID,
            $name,
            $image,
            $description,
            $itemPriceRequests
        );
        $itemServiceResponse = $this->itemService->createNewItem($itemRequest);
        if (!$itemServiceResponse->isSuccess()) {
            $this->dispatch('page-error', true, $itemServiceResponse->getMessage());
            return;
        }
        $this->dispatch('page-success', true, 'Berhasil menyimpan data barang');
        $this->resetFormField();
        $this->goToStep(1);
    }

    private function resetFormField()
    {
        $this->name = '';
        $this->category = null;
        $this->description = '';
        $this->image = null;
        $this->prices = Pricing::INITIAL_PRICING;
    }

    public function goToStep($step)
    {
        $this->step = $step;
    }

    public function render()
    {
        return view('livewire.features.item.form-create');
    }
}
