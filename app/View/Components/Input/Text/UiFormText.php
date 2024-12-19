<?php

namespace App\View\Components\Input\Text;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiFormText extends Component
{
    public $baseClass;
    public $parentClassName;
    public $id;
    public $label;
    public $validatorKey;
    public $validatorField;

    /**
     * UiFormText constructor.
     * @param string $id
     * @param string $label
     * @param string $parentClassName
     * @param string $validatorKey
     * @param string $validatorField
     */
    public function __construct($id = '', $label = 'Form Label', $parentClassName = '', $validatorKey = '', $validatorField = '')
    {
        $this->id = $id;
        $this->label = $label;
        $this->parentClassName = $parentClassName;
        if ($id === '') {
            $this->id = uniqid('form-text-');
        }
        $themeClass = 'border-neutral-300 focus:border-neutral-500';
        $this->baseClass = 'w-full bg-white text-[0.725rem] px-[0.825rem] py-[0.45rem] rounded-[4px] text-neutral-700 border outline-none focus:outline-none focus:ring-0 transition duration-300 ease-in-out disabled:border-neutral-300 disabled:text-neutral-300 disabled:bg-neutral-50';
        $this->baseClass = implode(' ', [$this->baseClass, $themeClass]);
        $this->validatorField = $validatorField;
        $this->validatorKey = $validatorKey;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.text.ui-form-text');
    }
}
