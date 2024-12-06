<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $size;
    public $theme;
    public $baseClass;
    public $spinnerClass;
    public $loadingTarget;

    /**
     * Create a new component instance.
     * @param string $size
     * @param string $theme
     * @param string $loadingTarget
     */
    public function __construct($size = 'normal', $theme = 'primary', $loadingTarget = '')
    {
        $this->size = $size;
        $this->loadingTarget = $loadingTarget;
        switch ($theme) {
            case 'primary-outline':
                $this->baseClass = 'flex bg-white border border-[#CBD5E1] text-brand-500 cursor-pointer transition duration-300 ease-in-out hover:bg-brand-50 disabled:cursor-default disabled:bg-brand-50';
                $this->spinnerClass = 'text-brand-500';
                break;
            case 'danger':
                $this->baseClass = 'flex bg-danger-500 border border-danger-500 text-white cursor-pointer transition duration-300 ease-in-out hover:bg-danger-700 hover:border-danger-700 disabled:cursor-default disabled:bg-danger-700 disabled:border-danger-700';
                $this->spinnerClass = 'text-white';
                break;
            case 'danger-outline':
                $this->baseClass = 'flex bg-white border border-[#CBD5E1] text-danger-500 cursor-pointer transition duration-300 ease-in-out hover:bg-danger-50 disabled:cursor-default disabled:bg-danger-50';
                $this->spinnerClass = 'text-danger-500';
                break;
            case 'primary':
            default:
                $this->baseClass = 'flex bg-brand-500 border border-brand-500 text-white cursor-pointer transition duration-300 ease-in-out hover:bg-brand-700 hover:border-brand-700 disabled:cursor-default disabled:bg-brand-700 disabled:border-brand-700';
                $this->spinnerClass = 'text-white';
                break;
        }

        switch ($size) {
            case 'small':
                $this->baseClass .= ' text-[0.725rem] px-[1rem] py-[0.575rem] rounded-[4px]';
                break;
            case 'extra-small':
                $this->baseClass .= ' text-[0.625rem] px-[1rem] py-[0.525rem] rounded-[4px]';
                break;
            case 'normal':
            default:
                $this->baseClass .= ' text-[0.825rem] px-[1.25rem] py-[0.75rem] rounded-[4px]';
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button.button');
    }
}
