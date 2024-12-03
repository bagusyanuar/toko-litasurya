<?php

namespace App\View\Components\Table;

use App\Helpers\Pagination\Paginate;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public $pageLength;
    public $perPage;
    public $perPageModel;
    public $onPerPageChange;
    public $totalRows;
    public $currentPage;
    public $currentPageModel;
    public $pageRange = [];
    public $totalPage = 0;
    public $onPageChange;
    public $onNextPageChange;
    public $onLastPageChange;
    public $onPreviousPageChange;
    public $onFirstPageChange;

    /**
     * Create a new component instance.
     * @param string $onPerPageChange
     * @param string $perPageModel
     * @param string $currentPageModel
     * @param array $pageLength
     * @param int $totalRows
     * @param int $currentPage
     * @param int $perPage
     * @param string $onPageChange
     * @param string $onNextPageChange
     * @param string $onLastPageChange
     * @param string $onPreviousPageChange
     * @param string $onFirstPageChange
     */
    public function __construct(
        $onPerPageChange,
        $perPageModel = 'perPage' ,
        $currentPageModel = 'currentPage' ,
        $pageLength = [10, 25, 50],
        $totalRows = 0,
        $currentPage = 1,
        $perPage = 1,
        $onPageChange = '',
        $onNextPageChange = '',
        $onLastPageChange = '',
        $onPreviousPageChange = '',
        $onFirstPageChange = ''
    )
    {
        $this->onPerPageChange = $onPerPageChange;
        $this->perPageModel = $perPageModel;
        $this->currentPageModel = $currentPageModel;
        $this->pageLength = $pageLength;
        $this->totalRows = $totalRows;
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
        $this->onPageChange = $onPageChange;
        $this->onNextPageChange = $onNextPageChange;
        $this->onLastPageChange = $onLastPageChange;
        $this->onPreviousPageChange = $onPreviousPageChange;
        $this->onFirstPageChange = $onFirstPageChange;
        $paginateResponse = Paginate::paginate($totalRows, $perPage, $currentPage);
        $this->pageRange = $paginateResponse->getPageRange();
        $this->totalPage = $paginateResponse->getTotalPage();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.table');
    }
}
