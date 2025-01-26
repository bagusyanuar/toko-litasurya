<?php

namespace App\View\Components\Gxui\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public $isLoading;

    /**
     * Create a new component instance.
     * @param $isLoading
     */
    public function __construct($isLoading)
    {
        $this->isLoading = $isLoading;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.table.table');
    }
}
