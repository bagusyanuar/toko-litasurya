<?php

namespace App\View\Components\Notification;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiNotification extends Component
{
    public $timeToClose;

    /**
     * Create a new component instance.
     * @param int $timeToClose
     */
    public function __construct($timeToClose = 1000)
    {
        $this->timeToClose = $timeToClose;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification.ui-notification');
    }
}
