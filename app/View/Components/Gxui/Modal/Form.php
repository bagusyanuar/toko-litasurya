<?php

namespace App\View\Components\Gxui\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $show;

    /**
     * Create a new component instance.
     * @param $show
     */
    public function __construct($show)
    {
        $this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.modal.form');
    }
}
