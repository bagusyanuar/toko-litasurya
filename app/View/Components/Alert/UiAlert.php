<?php

namespace App\View\Components\Alert;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiAlert extends Component
{
    public $show;
    public $handleClose;
    public $timeToClose;

    /**
     * Create a new component instance.
     * @param bool $show
     * @param string $handleClose
     * @param int $timeToClose
     */
    public function __construct($show = false, $handleClose = '', $timeToClose = 1000)
    {
        $this->show = $show;
        $this->handleClose = $handleClose;
        $this->timeToClose = $timeToClose;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert.ui-alert');
    }
}
