<?php

namespace App\View\Components\Alert;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiAlertConfirm extends Component
{
    public $handleSubmit;

    /**
     * Create a new component instance.
     * @param string $handleSubmit
     */
    public function __construct($handleSubmit = '')
    {
        $this->handleSubmit = $handleSubmit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert.ui-alert-confirm');
    }
}
