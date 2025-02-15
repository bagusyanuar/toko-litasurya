<?php

namespace App\View\Components\Gxui\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
    public $store;

    /**
     * Create a new component instance.
     * @param $store
     */
    public function __construct($store)
    {
        $this->store = $store;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.table.action');
    }
}
