<?php

namespace App\View\Components\Table\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonEdit extends Component
{
    public $baseClass;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->baseClass = 'bg-orange-500 text-white py-1 px-2 rounded-[4px] hover:bg-orange-600 hover:text-white transition-all duration-200 ease-in';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.components.button-edit');
    }
}
