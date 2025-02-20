<?php

namespace App\View\Components\Gxui\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $show;
    public $width;
    public $maxHeight;

    /**
     * Create a new component instance.
     * @param $show
     * @param string $width
     * @param string $maxHeight
     */
    public function __construct($show, $width = '350px', $maxHeight = 'max-content')
    {
        $this->show = $show;
        $this->width = $width;
        $this->maxHeight = $maxHeight;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.modal.form');
    }
}
