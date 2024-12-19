<?php

namespace App\View\Components\Input\File;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiDropzone extends Component
{
    public $parentClassName;
    public $label;
    public $dropData;
    public $dropInit;

    /**
     * Create a new component instance.
     * @param $dropData
     * @param $dropInit
     * @param string $parentClassName
     * @param string $label
     */
    public function __construct($dropData, $dropInit, $parentClassName = '', $label = '')
    {
        $this->dropData = $dropData;
        $this->dropInit = $dropInit;
        $this->parentClassName = $parentClassName;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.file.ui-dropzone');
    }
}
