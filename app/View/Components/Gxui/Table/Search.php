<?php

namespace App\View\Components\Gxui\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    public $parentClassName;

    /**
     * Create a new component instance.
     * @param string $parentClassName
     */
    public function __construct($parentClassName = '')
    {
        $this->parentClassName = $parentClassName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.table.search');
    }
}
