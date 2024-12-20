<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiTable extends Component
{
    public $onLoading;

    /**
     * Create a new component instance.
     * @param bool $onLoading
     */
    public function __construct($onLoading = false)
    {
        $this->onLoading = $onLoading;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.ui-table');
    }
}
