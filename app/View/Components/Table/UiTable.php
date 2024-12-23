<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiTable extends Component
{
    public $onLoading;
    public $onPerPageChange;
    public $currentPage;
    public $totalPage;

    /**
     * Create a new component instance.
     * @param bool $onLoading
     * @param string $onPerPageChange
     * @param int $currentPage
     * @param int $totalPage
     */
    public function __construct($onLoading = false, $onPerPageChange = '', $currentPage = 1, $totalPage = 0)
    {
        $this->onLoading = $onLoading;
        $this->onPerPageChange = $onPerPageChange;
        $this->currentPage = $currentPage;
        $this->totalPage = $totalPage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.ui-table');
    }
}
