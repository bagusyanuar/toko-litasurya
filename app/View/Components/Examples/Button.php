<?php

namespace App\View\Components\Examples;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $bindLoading;

    /**
     * Create a new component instance.
     * @param string $bindLoading
     */
    public function __construct($bindLoading = 'button-loading')
    {
        $this->bindLoading = $bindLoading;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.examples.button');
    }
}
