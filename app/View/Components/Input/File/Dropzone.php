<?php

namespace App\View\Components\Input\File;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dropzone extends Component
{
    public $targetName;
    public $dispatcher;
    public $afterDispatch;
    public $dropRef;
    public $parentClassName;
    public $label;

    /**
     * Create a new component instance.
     * @param $dropRef
     * @param string $parentClassName
     * @param string $label
     * @param string $targetName
     * @param string $dispatcher
     * @param string $afterDispatch
     */
    public function __construct($dropRef, $dispatcher, $parentClassName = '', $label = '', $targetName = 'file', $afterDispatch = '')
    {
        $this->dropRef = $dropRef;
        $this->parentClassName = $parentClassName;
        $this->label = $label;
        $this->targetName = $targetName;
        $this->dispatcher = $dispatcher;
        if ($afterDispatch !== '') {
            $this->afterDispatch = 'function() { ' . $afterDispatch . ' }';
        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.file.dropzone');
    }
}
