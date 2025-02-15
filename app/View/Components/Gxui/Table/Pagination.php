<?php

namespace App\View\Components\Gxui\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $store;
    public $dispatcher;

    /**
     * Pagination constructor.
     * @param string $store
     * @param string $dispatcher
     */
    public function __construct($store = '', $dispatcher = '')
    {
        $this->store = $store;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.table.pagination');
    }
}
