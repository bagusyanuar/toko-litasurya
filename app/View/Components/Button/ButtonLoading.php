<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonLoading extends Component
{
    public $loadingText;
    public $loadingTarget;
    public $baseClass;
    public $theme;
    public $mutate;

    /**
     * Create a new component instance.
     * @param string $loadingText
     * @param string $loadingTarget
     * @param string $theme
     * @param bool $mutate
     */
    public function __construct($loadingText = '', $loadingTarget = '', $theme = 'primary', $mutate = true)
    {
        $this->loadingText = $loadingText;
        $this->loadingTarget = $loadingTarget;
        $this->mutate = $mutate;
        $this->baseClass = 'flex text-[0.675rem] px-[1.25rem] py-[0.65rem] rounded-[4px] bg-brand-500 border border-brand-500 text-white cursor-pointer transition duration-300 ease-in-out hover:bg-brand-700 hover:border-brand-700 disabled:cursor-default disabled:bg-brand-700 disabled:border-brand-700';
        if ($theme === 'outline') {
            $this->baseClass = 'flex text-[0.675rem] px-[1.25rem] py-[0.65rem] rounded-[4px] bg-white border border-neutral-300 text-brand-500 cursor-pointer transition duration-300 ease-in-out hover:bg-brand-50 hover:border-neutral-400 disabled:cursor-default disabled:bg-brand-50 disabled:border-neutral-400';

        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button.button-loading');
    }
}
