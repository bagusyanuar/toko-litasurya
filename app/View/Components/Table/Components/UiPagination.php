<?php

namespace App\View\Components\Table\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiPagination extends Component
{
    public $currentPage;
    public $totalPage;
    public $shownPages;
    public $onFirstPageChange;
    public $onPreviousPageChange;
    public $onNextPageChange;
    public $onLastPageChange;
    public $onPageChange;

    /**
     * Create a new component instance.
     * @param int $currentPage
     * @param int $totalPage
     * @param array $shownPages
     * @param string $onFirstPageChange
     * @param string $onPreviousPageChange
     * @param string $onNextPageChange
     * @param string $onLastPageChange
     * @param string $onPageChange
     */
    public function __construct(
        $currentPage = 0,
        $totalPage = 0,
        $shownPages = [],
        $onFirstPageChange = '',
        $onPreviousPageChange = '',
        $onNextPageChange = '',
        $onLastPageChange = '',
        $onPageChange = ''
    )
    {
        $this->currentPage = $currentPage;
        $this->totalPage = $totalPage;
        $this->shownPages = $shownPages;
        $this->onFirstPageChange = $onFirstPageChange;
        $this->onPreviousPageChange = $onPreviousPageChange;
        $this->onNextPageChange = $onNextPageChange;
        $this->onLastPageChange = $onLastPageChange;
        $this->onPageChange = $onPageChange;
//        dd(is_array($this->shownPages), $this->shownPages);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.components.ui-pagination');
    }
}
