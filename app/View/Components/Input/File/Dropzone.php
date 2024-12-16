<?php

namespace App\View\Components\Input\File;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dropzone extends Component
{
    public $targetName;
    public $dispatcher;
    public $dispatchKey;
    public $afterDispatch;
    public $dropRef;
    public $parentClassName;
    public $label;
    public $loadingKey;

    /**
     * Create a new component instance.
     * @param $dropRef
     * @param string $dispatcher
     * @param $dispatchKey
     * @param string $parentClassName
     * @param string $label
     * @param string $targetName
     * @param string $afterDispatch
     * @param string $loadingKey
     */
    public function __construct($dropRef, $dispatcher, $dispatchKey, $parentClassName = '', $label = '', $targetName = 'file', $afterDispatch = '', $loadingKey = 'loading')
    {
        $this->dropRef = $dropRef;
        $this->parentClassName = $parentClassName;
        $this->label = $label;
        $this->targetName = $targetName;
        $this->dispatcher = $dispatcher;
        $this->dispatchKey = $dispatchKey;
        $this->loadingKey = $loadingKey;
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
