<?php

namespace App\Livewire\Features\Item;

use App\Domain\Web\Item\ItemFilter;
use App\Helpers\Pagination\Paginate;
use App\Services\Web\ItemService;
use Livewire\Component;
use Livewire\Attributes\On;

class Lists extends Component
{
    /** @var ItemService $service */
    private $service;

    /** @var ItemFilter $filter */
    private $filter;

    public $data = [];
    public $onLoading = true;
    public $param = '';
    public $pageLength = Paginate::PAGE_LENGTH;
    public $perPage = Paginate::PAGE_LENGTH[0];
    public $totalRows = 0;
    public $currentPage = 1;
    public $totalPage = 0;

    public function boot(ItemService $service)
    {
        $this->service = $service;
        $this->filter = new ItemFilter($this->param, $this->currentPage, $this->perPage);
    }

    #[On('fetch-items')]
    public function getDataItems()
    {
        $this->onLoading = true;
        $serviceResponse = $this->service->getDataItems($this->filter);
        if ($serviceResponse->isSuccess()) {
            $this->data = $serviceResponse->getData();
            $this->totalRows = $serviceResponse->getMeta()->getTotalRows();
            $this->currentPage = $serviceResponse->getMeta()->getPage();
        }
        $this->onLoading = false;
    }

    #[On('fetch-items-no-reload')]
    public function getDataItemsNoReload()
    {
        $serviceResponse = $this->service->getDataItems($this->filter);
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
        $serviceResponse = $this->service->getDataItems($this->filter);
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
        $this->getDataItemsNoReload();
    }

    public function onPageChange()
    {
        $this->filter->setPage($this->currentPage);
        $this->getDataItemsNoReload();
    }

    public function onNextPage()
    {
        $targetPage = $this->currentPage + 1;
        $this->filter->setPage($targetPage);
        $this->getDataItemsNoReload();
    }

    public function onLastPage($page)
    {
        $this->filter->setPage($page);
        $this->getDataItemsNoReload();
    }

    public function onPreviousPage()
    {
        $targetPage = $this->currentPage - 1;
        $this->filter->setPage($targetPage);
        $this->getDataItemsNoReload();
    }

    public function onFirstPage()
    {
        $this->filter->setPage(1);
        $this->getDataItemsNoReload();
    }

    public function onSearch()
    {
        $this->filter
            ->setParam($this->param)
            ->setPage(1);
        $this->getDataItemsNoReload();
    }

    public function render()
    {
        return view('livewire.features.item.lists');
    }
}
