<?php

namespace App\View\Components\Input\File;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dropzone extends Component
{
    public $initial;
    public $dropRef;
    public $parentClassName;
    public $label;

    /**
     * Create a new component instance.
     * @param $dropRef
     * @param $initial
     * @param string $parentClassName
     * @param string $label
     */
    public function __construct($dropRef, $initial, $parentClassName = '', $label = '')
    {
        $this->dropRef = $dropRef;
        $this->initial = $initial;
        $this->parentClassName = $parentClassName;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.file.dropzone');
    }
}
