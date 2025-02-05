<?php

namespace App\View\Components\Gxui\Input\Text;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Text extends Component
{
    public $baseClass;
    public $parentClassName;
    public $id;
    public $label;
    public $validatorKey;
    public $validatorField;

    /**
     * Create a new component instance.
     * @param string $label
     * @param string $parentClassName
     * @param string $validatorKey
     * @param string $validatorField
     */
    public function __construct($label = '', $parentClassName = '', $validatorKey = '', $validatorField = '')
    {
        $this->id = uniqid('input-text-');
        $this->label = $label;
        $this->parentClassName = $parentClassName;
        $this->validatorField = $validatorField;
        $this->validatorKey = $validatorKey;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.input.text.text');
    }
}
