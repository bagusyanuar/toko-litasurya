<?php

namespace App\View\Components\Table\Server;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiTable extends Component
{
    public $loading;
    public $pageLength;
    public $onPerPageChange;
    public $offset;
    public $perPage;
    public $totalRows;
    public $totalPage;
    public $currentPage;

    /**
     * Create a new component instance.
     * @param string $loading
     * @param $pageLength
     * @param $onPerPageChange
     * @param int $offset
     * @param int $perPage
     * @param int $totalRows
     * @param int $totalPage
     * @param int $currentPage
     */
    public function __construct(
        $loading,
        $pageLength,
        $onPerPageChange,
        $offset = 0,
        $perPage = 0,
        $totalRows = 0,
        $totalPage = 0,
        $currentPage = 0
    )
    {
        $this->loading = $loading;
        $this->pageLength = $pageLength;
        $this->onPerPageChange = $onPerPageChange;
        $this->offset = $offset;
        $this->perPage = $perPage;
        $this->totalRows = $totalRows;
        $this->totalPage = $totalPage;
        $this->currentPage = $currentPage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.server.ui-table');
    }
}
