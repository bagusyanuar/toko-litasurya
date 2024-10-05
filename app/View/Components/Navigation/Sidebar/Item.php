<?php

namespace App\View\Components\Navigation\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    public $title;
    public $to;
    public $materialIcon;

    /**
     * Create a new component instance.
     * @param string $title
     * @param string $to
     * @param string $materialIcon
     */
    public function __construct($title = '', $to = '#', $materialIcon = 'circle')
    {
        $this->title = $title;
        $this->to = $to;
        $this->materialIcon = $materialIcon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.sidebar.item');
    }
}
