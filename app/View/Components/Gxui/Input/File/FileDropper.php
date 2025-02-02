<?php

namespace App\View\Components\Gxui\Input\File;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileDropper extends Component
{
    public $parentClassName;
    public $label;
    public $dropperID;
    public $dropperLoading;

    /**
     * Create a new component instance.
     * @param $dropperID
     * @param string $parentClassName
     * @param string $label
     * @param string $dropperLoading
     */
    public function __construct($dropperID, $parentClassName = '', $label = '', $dropperLoading = 'false')
    {
        $this->dropperID = $dropperID;
        $this->parentClassName = $parentClassName;
        $this->label = $label;
        $this->dropperLoading = $dropperLoading;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.input.file.file-dropper');
    }
}
