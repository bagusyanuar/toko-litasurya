<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PasswordIcon extends Component
{
    public $size;
    public $baseClass;
    public $iconClass;
    public $showPasswordClass;

    /**
     * Create a new component instance.
     * @param string $size
     */
    public function __construct($size = 'normal')
    {
        $this->size = $size;
        $this->baseClass = 'rounded-[4px] border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-brand-500 transition duration-300 ease-in-out';
        switch ($size) {
            case 'small':
                $this->baseClass .= ' text-[0.725em] px-[2.05rem] py-[0.45rem] rounded-[4px]';
                $this->iconClass = 'ps-[0.825rem] text-[0.875em]';
                $this->showPasswordClass = 'pe-[0.825rem] text-[0.875em]';
                break;
            case 'extra-small':
                $this->baseClass .= ' text-[0.625em] px-[1.75rem] py-[0.25rem] rounded-[4px]';
                $this->iconClass = 'ps-[0.825rem] text-[0.67em]';
                $this->showPasswordClass = 'pe-[0.825rem] text-[0.67em]';
                break;
            case 'normal':
            default:
                $this->baseClass .= ' text-[0.875em] px-[2.5rem] py-[0.675rem] rounded-[4px]';
                $this->iconClass = 'ps-[1.05rem] text-[1em]';
                $this->showPasswordClass = 'pe-[1.05rem] text-[1em]';
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.password-icon');
    }
}
