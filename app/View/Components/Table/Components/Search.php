<?php

namespace App\View\Components\Table\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    public $baseClass;
    public $paramModel;
    public $dispatcher;

    /**
     * Create a new component instance.
     * @param string $paramModel
     * @param string $dispatcher
     */
    public function __construct($paramModel = 'param', $dispatcher = 'onSearch')
    {
        $this->paramModel = $paramModel;
        $this->dispatcher = $dispatcher;
        $this->baseClass = 'w-full text-[0.725em] ps-[2.05rem] pe-[0.825rem] py-[0.45rem] rounded-[4px] rounded-[4px] text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in-out';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.components.search');
    }
}
