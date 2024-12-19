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
    public $dropRef;
    public $dropLoading;

    /**
     * Create a new component instance.
     * @param $dropData
     * @param $dropInit
     * @param $dropRef
     * @param string $parentClassName
     * @param string $label
     * @param bool $dropLoading
     */
    public function __construct($dropData, $dropInit, $dropRef, $parentClassName = '', $label = '', $dropLoading = false)
    {
        $this->dropData = $dropData;
        $this->dropInit = $dropInit;
        $this->dropRef = $dropRef;
        $this->parentClassName = $parentClassName;
        $this->label = $label;
        $this->dropLoading = $dropLoading;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.file.ui-dropzone');
    }
}
