<?php

namespace App\View\Components\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalForm extends Component
{
    public $modalID;
    public $formTitle;

    /**
     * Create a new component instance.
     * @param $modalID
     * @param string $formTitle
     */
    public function __construct($modalID, $formTitle = 'Modal Form')
    {
        $this->modalID = $modalID;
        $this->formTitle = $formTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal.modal-form');
    }
}
