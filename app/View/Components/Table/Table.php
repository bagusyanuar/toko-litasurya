<?php

namespace App\View\Components\Table;

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

    /**
     * Create a new component instance.
     * @param string $onPerPageChange
     * @param string $perPageModel
     * @param array $pageLength
     * @param int $totalRows
     */
    public function __construct($onPerPageChange, $perPageModel = 'perPage' , $pageLength = [10, 25, 50], $totalRows = 0)
    {
        $this->onPerPageChange = $onPerPageChange;
        $this->perPageModel = $perPageModel;
        $this->pageLength = $pageLength;
        $this->totalRows = $totalRows;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.table');
    }
}
