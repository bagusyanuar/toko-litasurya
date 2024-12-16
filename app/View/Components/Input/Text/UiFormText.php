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

    /**
     * UiFormText constructor.
     * @param string $id
     * @param string $label
     * @param string $parentClassName
     */
    public function __construct($id = '', $label = 'Form Label', $parentClassName = '')
    {
        $this->id = $id;
        $this->label = $label;
        $this->parentClassName = $parentClassName;
        if ($id === '') {
            $this->id = uniqid('form-text-');
        }
        $this->baseClass = 'w-full bg-white text-[0.725rem] px-[0.825rem] py-[0.45rem] rounded-[4px] text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in-out disabled:border-neutral-300 disabled:text-neutral-300 disabled:bg-neutral-50';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.text.ui-form-text');
    }
}
