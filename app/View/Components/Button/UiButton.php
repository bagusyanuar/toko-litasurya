<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiButton extends Component
{
    public $baseClass;
    public $fill;

    /**
     * UiButton constructor.
     * @param string $fill
     */
    public function __construct($fill = 'contained')
    {
        $this->baseClass = 'flex gap-1 text-[0.675rem] px-[1.25rem] py-[0.65rem] rounded-[4px] cursor-pointer transition duration-300 ease-in-out disabled:cursor-default';
        if ($fill === 'outlined') {
            $this->baseClass = implode(' ', [$this->baseClass, 'bg-white border border-[#CBD5E1] text-brand-500 hover:bg-brand-50 disabled:bg-brand-50']);
        } else {
            $this->baseClass = implode(' ', [$this->baseClass, 'bg-brand-500 border border-brand-500 text-white hover:bg-brand-700 hover:border-brand-700 disabled:bg-brand-700 disabled:border-brand-700']);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button.ui-button');
    }
}
