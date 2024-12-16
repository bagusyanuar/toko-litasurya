<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonDropzone extends Component
{
    public $dropEvent;
    public $loadingKey;


    /**
     * Create a new component instance.
     * @param $dropEvent
     * @param string $loadingKey
     */
    public function __construct($dropEvent, $loadingKey = 'loading')
    {
        $this->dropEvent = $dropEvent;
        $this->loadingKey = $loadingKey;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button.button-dropzone');
    }
}
