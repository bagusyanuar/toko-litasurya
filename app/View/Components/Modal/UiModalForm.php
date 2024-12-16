<?php

namespace App\View\Components\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiModalForm extends Component
{
    public $open;
    public $handleClose;

    /**
     * UiModalForm constructor.
     * @param bool $open
     * @param string $handleClose
     */
    public function __construct($open = false, $handleClose = '')
    {
        $this->open = $open;
        $this->handleClose = $handleClose;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal.ui-modal-form');
    }
}
