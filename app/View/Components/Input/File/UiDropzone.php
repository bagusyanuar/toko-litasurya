<?php

namespace App\View\Components\Input\File;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiDropzone extends Component
{
    public $parentClassName;
    public $label;
    public $dropID;
    public $dropLoading;

    /**
     * Create a new component instance.
     * @param $dropID
     * @param string $parentClassName
     * @param string $label
     * @param bool $dropLoading
     */
    public function __construct($dropID, $parentClassName = '', $label = '', $dropLoading = false)
    {
        $this->dropID = $dropID;
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
