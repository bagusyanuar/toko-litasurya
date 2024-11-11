<?php

namespace App\View\Components\Container;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $baseClass;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->baseClass = 'bg-white border border-neutral-300 rounded-md px-3 py-2 w-full shadow-sm';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.container.card');
    }
}
