<?php

namespace App\Livewire\Features\Category;

use App\Domain\Web\Category\CategoryFilter;
use App\Helpers\Pagination\Paginate;
use App\Services\CategoryService;
use Livewire\Component;
    use Livewire\Attributes\On;

class Lists extends Component
{
    /** @var $service CategoryService */
    protected $service;

    /** @var $filter CategoryFilter */
    protected $filter;

    public $data = [];
    public $onLoading = true;
    public $param = '';
    public $pageLength = Paginate::PAGE_LENGTH;
    public $perPage = Paginate::PAGE_LENGTH[0];
    public $totalRows = 0;
    public $currentPage = 1;
    public $totalPage = 0;

    protected $listeners = [
        'getDataCategories'
    ];

    public function boot(CategoryService $categoryService)
    {
        $this->service = $categoryService;
        $this->filter = new CategoryFilter($this->param, $this->currentPage, $this->perPage);
    }

    #[On('fetch-categories')]
    public function getDataCategories($page, $perPage)
    {
//        dd($page, $perPage);
        $serviceResponse = $this->service->getDataCategories($this->filter);
        if ($serviceResponse->isSuccess()) {
            $this->data = $serviceResponse->getData();
            $this->totalRows = $serviceResponse->getMeta()->getTotalRows();
            $this->currentPage = $serviceResponse->getMeta()->getPage();
        }
    }

    #[On('fetch-categories-no-reload')]
    public function getDataCategoriesNoReload()
    {
        $serviceResponse = $this->service->getDataCategories($this->filter);
        if ($serviceResponse->isSuccess()) {
            $this->data = $serviceResponse->getData();
            if (count($this->data) <= 0 && $this->currentPage > 1) {
                $this->forceToPreviousPage();
            } else {
                $this->totalRows = $serviceResponse->getMeta()->getTotalRows();
                $this->currentPage = $serviceResponse->getMeta()->getPage();
            }
        }
    }

    private function forceToPreviousPage()
    {
        $this->currentPage = $this->currentPage - 1;
        $this->filter->setPage($this->currentPage);
        $serviceResponse = $this->service->getDataCategories($this->filter);
        if ($serviceResponse->isSuccess()) {
            $this->data = $serviceResponse->getData();
            $this->totalRows = $serviceResponse->getMeta()->getTotalRows();
            $this->currentPage = $serviceResponse->getMeta()->getPage();
        }
    }

    public function onPerPageChange()
    {
        $this->currentPage = 1;
        $this->filter->setPerPage($this->perPage);
        $this->filter->setPage($this->currentPage);
        $this->getDataCategoriesNoReload();
    }

    public function onPageChange()
    {
        $this->filter->setPage($this->currentPage);
        $this->getDataCategoriesNoReload();
    }

    public function onNextPage()
    {
        $targetPage = $this->currentPage + 1;
        $this->filter->setPage($targetPage);
        $this->getDataCategoriesNoReload();
    }

    public function onLastPage($page)
    {
        $this->filter->setPage($page);
        $this->getDataCategoriesNoReload();
    }

    public function onPreviousPage()
    {
        $targetPage = $this->currentPage - 1;
        $this->filter->setPage($targetPage);
        $this->getDataCategoriesNoReload();
    }

    public function onFirstPage()
    {
        $this->filter->setPage(1);
        $this->getDataCategoriesNoReload();
    }

    public function onSearch()
    {
        $this->filter
            ->setParam($this->param)
            ->setPage(1);
        $this->getDataCategoriesNoReload();
    }


    public function render()
    {
        return view('livewire.features.category.lists');
    }
}
