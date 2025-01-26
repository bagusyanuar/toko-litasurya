<?php

namespace App\View\Components\Gxui\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Th extends Component
{
    public $title;
    public $align;
    public $className;

    /**
     * Create a new component instance.
     * @param $title
     * @param string $className
     * @param string $align
     */
    public function __construct($title, $className = '', $align = 'center')
    {
        $this->title = $title;
        $this->className = $className;
        $this->align = 'text-center';
        switch ($align) {
            case 'left':
                $this->align = 'text-start';
                break;
            case 'right':
                $this->align = 'text-right';
                break;
            default:
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.table.th');
    }
}
