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

    /**
     * Create a new component instance.
     * @param string $loading
     * @param $pageLength
     * @param $onPerPageChange
     */
    public function __construct($loading, $pageLength, $onPerPageChange)
    {
        $this->loading = $loading;
        $this->pageLength = $pageLength;
        $this->onPerPageChange = $onPerPageChange;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.server.ui-table');
    }
}
