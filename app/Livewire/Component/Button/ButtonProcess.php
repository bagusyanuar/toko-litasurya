<?php

namespace App\Livewire\Component\Button;

use Livewire\Component;
use Livewire\Attributes\On;

class ButtonProcess extends Component
{
    public $text;
    public $store;
    public $loadingState;
    public $storeEvent;

    public function render()
    {
        return view('livewire.component.button.button-process');
    }
}
