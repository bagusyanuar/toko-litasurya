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

    /**
     * Create a new component instance.
     * @param string $shownPages
     * @param string $perPageOptions
     * @param int $currentPage
     * @param int $totalRows
     * @param int $totalPages
     * @param string $handlePerPageChange
     * @param string $handlePageChange
     * @param string $handlePreviousPageChange
     * @param string $handleNextPageChange
     */
    public function __construct(
        $shownPages = '[]',
        $perPageOptions = '[10, 25, 50]',
        $currentPage = 0,
        $totalRows = 0,
        $totalPages = 0,
        $handlePerPageChange = '',
        $handlePageChange = '',
        $handlePreviousPageChange = '',
        $handleNextPageChange = ''
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
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.table.pagination');
    }
}
