<?php

namespace App\View\Components\Input\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select2 extends Component
{
    public $baseClass;
    public $id;
    public $options = [];

    /**
     * Create a new component instance.
     * @param string $id
     * @param array $options
     */
    public function __construct($id = '', $options = [])
    {
        $this->id = $id;
        $this->options = $options;
        $this->baseClass = '!text-[0.725rem] text-neutral-700 rounded-[4px] border !border-neutral-300 outline-none focus:outline-none focus:ring-0 !focus:border-neutral-500 transition duration-300 ease-in-out';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.select.select2');
    }
}
