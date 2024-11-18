<?php

namespace App\View\Components\Alert;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Success extends Component
{
    public $title;
    public $message;

    /**
     * Create a new component instance.
     * @param string $title
     * @param string $message
     */
    public function __construct($title = 'Success', $message = 'Message')
    {
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert.success');
    }
}
