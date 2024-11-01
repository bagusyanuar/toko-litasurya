<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextIcon extends Component
{
    public $size;
    public $materialIcon;
    public $baseClass;
    public $iconClass;
    public $parentClassName;

    /**
     * Create a new component instance.
     * @param string $size
     * @param string $materialIcon
     * @param string $parentClassName
     */
    public function __construct($size = 'normal', $materialIcon = 'circle', $parentClassName = '')
    {
        $this->size = $size;
        $this->materialIcon = $materialIcon;
        $this->parentClassName = $parentClassName;
        $this->baseClass = 'w-full rounded-[4px] text-neutral-500 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in-out';
        switch ($size) {
            case 'small':
                $this->baseClass .= ' text-[0.725em] ps-[2.05rem] pe-[0.825rem] py-[0.45rem] rounded-[4px]';
                $this->iconClass = 'ps-[0.825rem] text-[0.875em]';
                break;
            case 'extra-small':
                $this->baseClass .= ' text-[0.625em] ps-[1.75rem] pe-[0.675rem] py-[0.25rem] rounded-[4px]';
                $this->iconClass = 'ps-[0.825rem] text-[0.67em]';
                break;
            case 'normal':
            default:
                $this->baseClass .= ' text-[0.875em] ps-[2.5rem] pe-[1.05rem] py-[0.675rem] rounded-[4px]';
                $this->iconClass = 'ps-[1.05rem] text-[1em]';
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.text-icon');
    }
}
