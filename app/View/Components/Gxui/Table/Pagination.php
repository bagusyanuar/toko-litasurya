<?php

namespace App\View\Components\Gxui\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $perPageOptions;
    public $shownPages;
    public $currentPage;
    public $totalRows;
    public $totalPages;
    public $handlePerPageChange;
    public $handlePageChange;
    public $handlePreviousPageChange;
    public $handleNextPageChange;
    public $isLoading;

    /**
     * Create a new component instance.
     * @param string $shownPages
     * @param string $perPageOptions
     * @param int $currentPage
     * @param string $totalRows
     * @param string $totalPages
     * @param string $handlePerPageChange
     * @param string $handlePageChange
     * @param string $handlePreviousPageChange
     * @param string $handleNextPageChange
     * @param $isLoading
     */
    public function __construct(
        $shownPages = '[]',
        $perPageOptions = '[10, 25, 50]',
        $currentPage = 0,
        $totalRows = '0',
        $totalPages = '0',
        $handlePerPageChange = '',
        $handlePageChange = '',
        $handlePreviousPageChange = '',
        $handleNextPageChange = '',
        $isLoading = 'false'
    )
    {
        $this->shownPages = $shownPages;
        $this->perPageOptions = $perPageOptions;
        $this->currentPage = $currentPage;
        $this->totalRows = $totalRows;
        $this->totalPages = $totalPages;
        $this->handlePerPageChange = $handlePerPageChange;
        $this->handlePageChange = $handlePageChange;
        $this->handlePreviousPageChange = $handlePreviousPageChange;
        $this->handleNextPageChange = $handleNextPageChange;
        $this->isLoading = $isLoading;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.table.pagination');
    }
}
