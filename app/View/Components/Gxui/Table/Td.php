<?php

namespace App\View\Components\Gxui\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Td extends Component
{
    public $className;

    /**
     * Create a new component instance.
     * @param string $className
     */
    public function __construct($className = '')
    {
        $this->className = $className;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.table.td');
    }
}
