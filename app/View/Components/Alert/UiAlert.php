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
    public $type;
    public $message;

    /**
     * Create a new component instance.
     * @param bool $show
     * @param string $handleClose
     * @param int $timeToClose
     * @param string $type
     * @param string $message
     */
    public function __construct($show = false, $handleClose = '', $timeToClose = 1000, $type = 'success', $message = '')
    {
        $this->show = $show;
        $this->handleClose = $handleClose;
        $this->timeToClose = $timeToClose;
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert.ui-alert');
    }
}
