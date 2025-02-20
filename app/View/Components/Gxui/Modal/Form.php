<?php

namespace App\View\Components\Gxui\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $show;
    public $width;

    /**
     * Create a new component instance.
     * @param $show
     * @param string $width
     */
    public function __construct($show, $width = '350px')
    {
        $this->show = $show;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.modal.form');
    }
}
