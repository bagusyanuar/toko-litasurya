<?php

namespace App\View\Components\Spacer;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Divider extends Component
{
    public $baseClass;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->baseClass = 'w-full border-neutral-300';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.spacer.divider');
    }
}
