<?php

namespace App\View\Components\Gxui\Input\Text;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextIcon extends Component
{
    public $baseClass;
    public $iconName;
    public $parentClassName;
    public $id;
    public $label;
    public $validatorKey;
    public $validatorField;

    /**
     * Create a new component instance.
     * @param string $iconName
     * @param string $label
     * @param string $parentClassName
     * @param string $validatorKey
     * @param string $validatorField
     */
    public function __construct(
        $iconName = 'circle',
        $label = '',
        $parentClassName = '',
        $validatorKey = '',
        $validatorField = ''
    )
    {
        $this->id = uniqid('input-text-');
        $this->label = $label;
        $this->parentClassName = $parentClassName;
        $this->validatorField = $validatorField;
        $this->validatorKey = $validatorKey;
        $this->iconName = $iconName;
        $this->baseClass = 'w-full text-[0.725em] ps-[2.05rem] pe-[0.825rem] py-[0.45rem] rounded-[4px] rounded-[4px] text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in-out';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.input.text.text-icon');
    }
}
