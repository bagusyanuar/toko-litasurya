<?php

namespace App\View\Components\Gxui\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    public $parentClassName;
    public $store;
    public $dispatcher;
    public $storeKey;
    public $debounceTime;

    /**
     * Create a new component instance.
     * @param $store
     * @param $dispatcher
     * @param string $storeKey
     * @param int $debounceTime
     * @param string $parentClassName
     */
    public function __construct(
        $store,
        $dispatcher,
        $storeKey = 'param',
        $debounceTime = 500,
        $parentClassName = ''
    )
    {
        $this->store = $store;
        $this->dispatcher = $dispatcher;
        $this->storeKey = $storeKey;
        $this->debounceTime = $debounceTime;
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
