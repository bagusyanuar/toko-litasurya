<?php

namespace App\View\Components\Gxui\Input\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select2 extends Component
{
    public $parentClassName;
    public $selectID;
    public $label;
    public $validatorKey;
    public $validatorField;

    /**
     * Create a new component instance.
     * @param $selectID
     * @param string $label
     * @param string $parentClassName
     * @param string $validatorKey
     * @param string $validatorField
     */
    public function __construct(
        $selectID,
        $label = '',
        $parentClassName = '',
        $validatorKey = '',
        $validatorField = ''
    )
    {
        $this->selectID = $selectID;
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
        return view('components.gxui.input.select.select2');
    }
}
