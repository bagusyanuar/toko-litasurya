<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonProcess extends Component
{
    public $loadingKey;

    /**
     * Create a new component instance.
     * @param string $loadingKey
     */
    public function __construct($loadingKey = 'loading')
    {
        $this->loadingKey = $loadingKey;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button.button-process');
    }
}
