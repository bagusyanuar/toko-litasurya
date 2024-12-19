<?php

namespace App\View\Components\Alert;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiAlert extends Component
{
    public $show;
    public $handleClose;

    /**
     * Create a new component instance.
     * @param bool $show
     * @param string $handleClose
     */
    public function __construct($show = false, $handleClose = '')
    {
        $this->show = $show;
        $this->handleClose = $handleClose;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert.ui-alert');
    }
}
