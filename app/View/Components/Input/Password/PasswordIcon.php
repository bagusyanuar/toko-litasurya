<?php

namespace App\View\Components\Input\Password;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PasswordIcon extends Component
{
    public $baseClass;
    public $parentClassName;
    public $iconShowPassword;

    /**
     * Create a new component instance.
     * @param string $parentClassName
     */
    public function __construct($parentClassName = '')
    {
        $this->parentClassName = $parentClassName;
        $this->baseClass = 'w-full text-[0.725em] px-[2.05rem] py-[0.45rem] rounded-[4px] rounded-[4px] text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in-out';
        $this->iconShowPassword = 'eye-off';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.password.password-icon');
    }
}
