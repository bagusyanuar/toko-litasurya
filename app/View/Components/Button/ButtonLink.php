<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonLink extends Component
{
    public $baseClass;
    public $to;

    /**
     * Create a new component instance.
     * @param string $to
     */
    public function __construct($to = '/')
    {
        $this->to = $to;
        $this->baseClass = 'flex text-[0.675rem] px-[1.25rem] py-[0.65rem] rounded-[4px] bg-brand-500 border border-brand-500 text-white cursor-pointer transition duration-300 ease-in-out hover:bg-brand-700 hover:border-brand-700 disabled:cursor-default disabled:bg-brand-700 disabled:border-brand-700';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button.button-link');
    }
}
