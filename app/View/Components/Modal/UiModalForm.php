<?php

namespace App\View\Components\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiModalForm extends Component
{
    public $open;
    public $handleClose;
    public $title;

    /**
     * UiModalForm constructor.
     * @param bool $open
     * @param string $handleClose
     * @param string $title
     */
    public function __construct($open = false, $handleClose = '', $title = 'Form Title')
    {
        $this->open = $open;
        $this->handleClose = $handleClose;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal.ui-modal-form');
    }
}
