<?php


namespace App\Helpers\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class PageComponent extends Component
{
    public $hasSuccess = false;
    public $hasError = false;
    public $sessionMessage = '';

    protected $listeners = [
        'setSuccess',
        'setError'
    ];

    #[On('page-success')]
    public function setSuccess($value, $message)
    {
        $this->hasSuccess = $value;
        $this->sessionMessage = $message;
    }

    #[On('page-error')]
    public function setError($value, $message)
    {
        $this->hasError = $value;
        $this->sessionMessage = $message;
    }
}
