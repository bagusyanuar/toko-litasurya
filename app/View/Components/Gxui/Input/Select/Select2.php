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
    public $store;
    public $options;
    public $validatorKey;
    public $validatorField;

    /**
     * Create a new component instance.
     * @param $store
     * @param $selectID
     * @param $options
     * @param string $label
     * @param string $parentClassName
     * @param string $validatorKey
     * @param string $validatorField
     */
    public function __construct(
        $store,
        $selectID,
        $options,
        $label = '',
        $parentClassName = '',
        $validatorKey = '',
        $validatorField = ''
    )
    {
        $this->store = $store;
        $this->selectID = $selectID;
        $this->options = $options;
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
